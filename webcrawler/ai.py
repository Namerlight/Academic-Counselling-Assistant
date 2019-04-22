import cgi
import numpy
import matplotlib.pyplot as plt
import mysql.connector
import sys
from mysql.connector import Error


list_of_student_scores = []
list_of_university_scores = []

# Connects to SQL database
# Database is named aca, user is root, no password
# Gives output on successful connection, error otherwise
try:
    connection = mysql.connector.connect(
        host='localhost',
        database='aca',
        user='root',
        password=''
    )
    if connection.is_connected():
            db_Info = connection.get_server_info()
            #print("Connected to MySQL database... MySQL Server version on ", db_Info)
            cursor = connection.cursor()
            cursor.execute("select database()")
            record = cursor.fetchone()
           # print("You're connected to", record)
except Error as e:
         print("Error while connecting to MySQL", e)

# Setting cursor to database head
cursor = connection.cursor()


# Calculates an university's overall score, used for the AI functionality for student suggestions
# Selects the needed information from the university and universities_requirements tables
# Converts all output data into int for calculation: rank, status, tot_students, gre, ielts and gpa
# Calculates the individual scores from each aspect, then sums up to get a total score, placing it in score
# Updates the universities requirements table with the final score and commits the update.
def calculate_uni_scores():
    sql0 = "SELECT COUNT(*) FROM universities_requirements"
    cursor.execute(sql0)
    num = str(cursor.fetchone())
    num = num.replace('(', '')
    num = num.replace(',)', '')
    num = int(num)
    count = 1
    while count <= num:
        sql1 = "SELECT university_name, gre_reqs, ielts_reqs, cgpa_reqs FROM universities_requirements WHERE uni_id = %s"
        cursor.execute(sql1, (count, ))
        uni_reqs = cursor.fetchone()
        uni_name = uni_reqs[0]
        gre, ielts, gpa = float(uni_reqs[1]), float(uni_reqs[2]), float(uni_reqs[3])
        sql2 = "SELECT id, status, total_student FROM universities WHERE name = %s"
        cursor.execute(sql2, (uni_name, ))
        info = cursor.fetchone()
        rank, own_status, tot_students = float(info[0]), info[1], info[2]
        tot_students = float(tot_students.replace(',', ""))
        if own_status == 'Private':
            sttscore = 50
        else:
            sttscore = 0
        rankscore = 500 - rank
        popscore = 100*(2.7**(1000/tot_students))
        grescore = 100*(2.7**(4/(100-gre)))
        ieltscore = 100*(2.7**(4/(100-ielts)))
        gpascore = 100*(2.7**(4/(100-gpa)))
        university_total = int(rankscore + popscore + sttscore + grescore + ieltscore + gpascore)
        sql3 = "UPDATE universities_requirements SET uni_score = %s WHERE uni_id = %s"
        cursor.execute(sql3, (university_total, count, ))
        connection.commit()
        count += 1

# Calculates a student's overall score, used for the AI functionality for student suggestions
# Selects the needed information from the students and competitive exams tables
# Converts all output data into int for calculation: gpa, ECAs, o and a level results, ielts, etc
# Calculates the individual scores from each aspect, then sums up to get a total score, placing it in academic point
# Updates the studennts table with the final score and commits the update.
def calculate_student_scores():
    sql0 = "SELECT COUNT(*) FROM students"
    cursor.execute(sql0)
    num = str(cursor.fetchone())
    num = num.replace('(', '')
    num = num.replace(',)', '')
    num = int(num)
    #print(num)
    count = 0
    sql0 = "SELECT username FROM students"
    cursor.execute(sql0)
    std_name = cursor.fetchall()
    #print(std_name)
    while count < num:
        std_str_nm = str(std_name[count])
        std_nm = std_str_nm.replace('(\'', '')
        std_nm = std_nm.replace('\',)', '')
       # print(std_nm)
        sql1 = "SELECT ssc_o_level, hsc_a_level, cgpa_bachelor, others FROM students WHERE username = %s"
        cursor.execute(sql1, (std_nm, ))
        std_info = cursor.fetchone()
        o_levels, a_levels, ug_cgpa, others = float(std_info[0]), float(std_info[1]), float(std_info[2]), std_info[3]
        #print(o_levels, a_levels, ug_cgpa, others)
        sql2 = "SELECT ielts FROM competitive_entrance_exams WHERE username = %s"
        cursor.execute(sql2, (std_nm, ))
        std_info = cursor.fetchone()
        try:
            ielts = str(std_info)
            ielts = ielts.replace('(', '')
            ielts = ielts.replace(',)', '')
            ielts = float(ielts)
          #  print(ielts)
        except ValueError:
            ielts = 0
        oscore = int(o_levels * 40)
        ascore = int(a_levels * 40)
        ugscore = int(ug_cgpa * 100)
        ieltscore = int((ielts * 20))
        if others is None:
            otherscore = 0
        else:
            otherscore = 150
        student_total = oscore + ascore + ugscore + otherscore + ieltscore
        #print(student_total)
        sql3 = "UPDATE students SET academic_point = %s WHERE username = %s"
        cursor.execute(sql3, (student_total, std_nm, ))
        connection.commit()
        count += 1


# Calculates the means and cross deviations of each point to find the line of best fit
# The outputs are the gradient and y-intercept of the final line of best fit
def calculate_coefficients(x, y):
    n = numpy.size(x)
    m_x, m_y = numpy.mean(x), numpy.mean(y)
    ss_xy = numpy.sum(y * x) - n * m_y * m_x
    ss_xx = numpy.sum(x * x) - n * m_x * m_x
    b_1 = ss_xy / ss_xx
    b_0 = m_y - b_1 * m_x
    return b_0, b_1


# First plots the original data as a scatter plot
# Then plots the regression line of best fit, then shows graph
def plot_regression_line(x, y, b):
    plt.scatter(x, y, color="m", marker="o", s=30)
    y_pred = b[0] + b[1] * x
    plt.plot(x, y_pred, color="g")
    plt.xlabel('Student Score')
    plt.ylabel('University Score')

# Calculates the suggestions by selecting students who were accepted into an university.
# sql0 selects students, sql1 selects universities, std_nm and uni_nm are used to convert to strings for searching
# Finds that student's academic point and that university's score and puts into
# list_of_student_scores and list_of_university_scores
# Creates a list of academic points with the respective university score
def calculate_ai_suggestions():
    sql0 = "SELECT COUNT(*) FROM student_acceptance"
    cursor.execute(sql0)
    num = str(cursor.fetchone())
    num = num.replace('(', '')
    num = num.replace(',)', '')
    num = int(num)
    count = 0
    sql0 = "SELECT username FROM student_acceptance"
    cursor.execute(sql0)
    std_name = cursor.fetchall()
    while count < num:
        std_str_nm = str(std_name[count])
        std_nm = std_str_nm.replace('(\'', '')
        std_nm = std_nm.replace('\',)', '')
        sql1 = "SELECT uni_name FROM  student_acceptance where username = %s"
        cursor.execute(sql1, (std_nm, ))
        uni_nm = str(cursor.fetchone())
        uni_nm = uni_nm.replace('(\'', '')
        uni_nm = uni_nm.replace('\',)', '')
        count += 1
        sql2 = "SELECT academic_point FROM students where username = %s"
        cursor.execute(sql2, (std_nm, ))
        std_scr = str(cursor.fetchone())
        std_scr = std_scr.replace('(', '')
        std_scr = int(float(std_scr.replace(',)', '')))
        sql3 = "SELECT uni_score FROM universities_requirements where university_name = %s"
        cursor.execute(sql3, (uni_nm, ))
        uni_scr = str(cursor.fetchone())
        uni_scr = uni_scr.replace('(', '')
        uni_scr = int(float(uni_scr.replace(',)', '')))
        list_of_student_scores.append(std_scr)
        list_of_university_scores.append(uni_scr)

calculate_student_scores()
calculate_ai_suggestions()

# Takes the two lists generated earlier, list_of_student_scores and list_of_unversity scores
# plot_regression_line Carries out linear regression and estimates the eqivalent uni score for the given student's academic point
# Outputs the top 5 unis within a 5% range of tht equivalent uni score
def suggest_university(username):
    sql0 = "SELECT academic_point FROM students WHERE username = %s"
    cursor.execute(sql0, (username, ))
    user_aca_point = cursor.fetchone()

    aca_point = str(user_aca_point)
    aca_point = aca_point.replace('(', '')
    aca_point = aca_point.replace(',)', '')
    aca_point = float(aca_point)

    x_axis = numpy.asarray(list_of_student_scores)
    y_axis = numpy.array(list_of_university_scores)
    line = calculate_coefficients(x_axis, y_axis)

    plot_regression_line(x_axis, y_axis, line)

    uni_base = aca_point * line[1] + line[0]
    uni_range_upper = int(uni_base*1.05)
    uni_range_lower = int(uni_base*0.95)
    sql2 = "SELECT university_name FROM universities_requirements WHERE uni_score BETWEEN %s and %s ORDER BY uni_score DESC"
    cursor.execute(sql2, (uni_range_lower, uni_range_upper))
    list_of_suggestions = cursor.fetchall()

   # print("Suggested Universities for", username, ":*")
    for uni_nm in list_of_suggestions[0:5]:
        uni_nm = str(uni_nm)
        uni_nm = uni_nm.replace('(\'', '')
        uni_nm = uni_nm.replace('\',)', '')
        uni_nm = uni_nm.replace('(\"', '')
        uni_nm = uni_nm.replace('\",)', '')
        print("*", uni_nm)


x = sys.argv[1]
suggest_university(x)

#suggest_university("engrmizan")
