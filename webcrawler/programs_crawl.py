from urllib.request import Request, urlopen
from bs4 import BeautifulSoup
import mysql.connector
from mysql.connector import Error


# Function that runs BeautifulSoup code to extract the html of a web page.
# Page is the address of the page, page_html is the extracted html of the page
# Requests that page, Mozilla Browser header to circumvent bot crawling protection
def find_page_html(page):
    page_being_crawled = page
    req = Request(page_being_crawled)
    req.add_header('User-Agent', 'Mozilla/5.0')
    page_html = urlopen(req)
    return page_html


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
            print("Connected to MySQL database... MySQL Server version on ", db_Info)
            cursor = connection.cursor()
            cursor.execute("select database()")
            record = cursor.fetchone()
            print("You're connected to", record)
except Error as e:
        print("Error while connecting to MySQL", e)

# Setting cursor to database head
cursor = connection.cursor()

# Creating table that will hold the data to be crawled by this script
sql0 = "CREATE TABLE IF NOT EXISTS universities_programs (university_name varchar(199), program_name varchar(199), GRE_reqs varchar(199), ielts_reqs varchar(199))"
cursor.execute(sql0)
connection.commit()

# Removing outdated data in order to be replaced with newer data
sql1 = "DELETE FROM universities_programs"
cursor.execute(sql1)
connection.commit()


# Places crawled data into the sql database, in universities_programs table
# Uni Name is manually in code, programs list is scraped and is in the form of a list item
def commit_to_sql(uni_name, programs_list):
    sql = "INSERT INTO universities_programs (university_name, program_name) VALUES (%s, %s)"
    val = (uni_name, programs_list)
    cursor.execute(sql, val)
    connection.commit()


# Address of the page containing the list of programs offered by the university is set as page_being_crawled
# Using find_page_html function defined earlier to get the html of the web page
# The html is converted into the BeautifulSoup4 format (which is the scraping library) and stored as bs_format
# List_of_programs and <university>_programs extract the data by searching for keywords or tags in the html doc
# Iterating through the <university>_programs list and pushing each item to the database, also printing the value.
# Similar structure is used for every function for every university, only varying due to page layout variations
def find_mit_programs():
    page_being_crawled = 'https://mitadmissions.org/discover/the-mit-education/majors-minors/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('table', attrs={'id': 'majors'})
    mit_programs = list_of_programs.findAll('strong')

    count = 0
    print("A list of a few MIT programs.")
    while count < len(mit_programs):
        print(mit_programs[count].text.strip())
        commit_to_sql("Massachusetts Institute of Technology (MIT)", mit_programs[count].text.strip())
        count += 12


def find_harvard_programs():
    page_being_crawled = 'https://college.harvard.edu/academics/fields-study/concentrations'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('div', attrs={'class': 'field field-name-body '
                                                             'field-type-text-with-summary field-label-hidden'})
    harvard_programs = list_of_programs.findAll('li')

    count = 0
    print("A list of a few Harvard programs.")
    while count < len(harvard_programs):
        print(harvard_programs[count].text.strip())
        commit_to_sql("Harvard University", harvard_programs[count].text.strip())
        count += 8


def find_stanford_programs():
    print("A list of a few Stanford programs.")
    for i in range(0, 2):
        if i == 0:
            page_being_crawled = 'https://online.stanford.edu/programs?availability%5Bavailable%5D=available'
        else:
            page_being_crawled = 'https://online.stanford.edu/programs?availability[available]=available&page=1'
        bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
        list_of_programs = bs_format.find('div', attrs={'class': 'search-results--table'})
        stanford_programs = list_of_programs.findAll('div', attrs={'headers': 'view-title-table-column'})

        count = 0
        while count < len(stanford_programs):
            print(stanford_programs[count].text.strip())
            commit_to_sql("Stanford University", stanford_programs[count].text.strip())
            count += 6


def find_caltech_programs():
    page_being_crawled = 'http://www.admissions.caltech.edu/explore/academics/options-majors'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    caltech_programs = bs_format.findAll('a', attrs={'target': '_blank'})
    del caltech_programs[0]
    del caltech_programs[37:]

    count = 0
    while count < len(caltech_programs):
        print(caltech_programs[count].text.strip())
        commit_to_sql("California Institute of Technology (Caltech)", caltech_programs[count].text.strip())
        count += 6


def find_oxford_programs():
    page_being_crawled = 'https://www.ox.ac.uk/admissions/undergraduate/colleges/which-oxford-colleges-offer-my-' \
                         'course?wssl=1#'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    oxford_programs = bs_format.findAll('h3')

    count = 0
    while count < len(oxford_programs):
        print(oxford_programs[count].text.strip())
        commit_to_sql("Oxford University", oxford_programs[count].text.strip())
        count += 7


def find_cambridge_programs():
    page_being_crawled = 'https://www.undergraduate.study.cam.ac.uk/courses'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')

    cambridge_programs = bs_format.findAll('h4')

    count = 0
    while count < len(cambridge_programs):
        print(cambridge_programs[count].text.strip())
        commit_to_sql("Cambridge University", cambridge_programs[count].text.strip())
        count += 6


def find_ntu_programs():
    page_being_crawled = 'https://www.ntu.edu.sg/Academics/Pages/UndergraduateProgrammes.aspx'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')

    ntu_programs = bs_format.findAll('a', attrs={'href': '/#'})

    count = 0
    while count < len(ntu_programs):
        print(ntu_programs[count].text.strip())
        commit_to_sql("Nanyang Technological University, Singapore (NTU)", ntu_programs[count].text.strip())
        count += 4


def find_ethzurich_programs():
    page_being_crawled = 'https://www.ethz.ch/students/en/studies/degree-programmes.html'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.findAll('div', attrs={'class': 'reference'})
    ethzurich_programs = list_of_programs[1].findAll('li', attrs={})

    count = 0
    while count < len(ethzurich_programs):
        print(ethzurich_programs[count].text.strip())
        commit_to_sql("ETH Zurich - Swiss Federal Institute of Technology", ethzurich_programs[count].text.strip())
        count += 1


def find_princeton_programs():
    page_being_crawled = 'https://admission.princeton.edu/academics/degrees-departments'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')

    princeton_programs = bs_format.findAll('strong')

    count = 1
    while count < len(princeton_programs):
        print(princeton_programs[count].text.strip())
        commit_to_sql("Princeton University", princeton_programs[count].text.strip())
        count += 6


def find_icl_programs():
    page_being_crawled = 'https://www.imperial.ac.uk/study/ug/courses/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')

    icl_programs = bs_format.findAll('h4', attrs={'class': 'title'})

    count = 1
    while count < len(icl_programs):
        print(icl_programs[count].text.strip())
        commit_to_sql("Imperial College London", icl_programs[count].text.strip())
        count += 17


def find_chicago_programs():
    page_being_crawled = 'http://physical-sciences.uchicago.edu/page/academic-departments-and-programs'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')

    list_of_programs = bs_format.findAll('ul')
    chicago_programs = list_of_programs[3].findAll('li')

    count = 1
    while count < len(chicago_programs):
        print(chicago_programs[count].text.strip())
        commit_to_sql("University of Chicago", chicago_programs[count].text.strip())
        count += 1


def find_ucl_programs():
    page_being_crawled = 'https://www.ucl.ac.uk/digital-presence-services/pgtaught/www/degreesearch.php'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    ucl_programs = bs_format.findAll('a', attrs={'target': '_top'})
    print(ucl_programs)

    count = 1
    while count < len(ucl_programs):
        print(ucl_programs[count].text.strip())
        commit_to_sql("UCL (University College London", ucl_programs[count].text.strip())
        count += 70


def find_nus_programs():
    page_being_crawled = 'http://www.nus.edu.sg/oam/undergraduate-programmes'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    nus_programs = bs_format.findAll('a', attrs={'target': '_blank'})
    del nus_programs[:10]
    del nus_programs[80:]

    count = 0
    while count < len(nus_programs):
        print(nus_programs[count].text.strip())
        commit_to_sql("National University of Singapore (NUS)", nus_programs[count].text.strip())
        count += 10


def find_cornell_programs():
    page_being_crawled = 'https://www.cornell.edu/academics/fields.cfm'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    cornell_programs = bs_format.findAll('a', attrs={'aria-describedby': 'majors'})

    count = 0
    while count < len(cornell_programs):
        print(cornell_programs[count].text.strip())
        commit_to_sql("Cornell University", cornell_programs[count].text.strip())
        count += 12


def find_yale_programs():
    page_being_crawled = 'http://catalog.yale.edu/ycps/majors-in-yale-college/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    yale_programs = bs_format.findAll('p', attrs={'class': 'hangindent'})
    print(yale_programs)

    count = 1
    while count < len(yale_programs):
        print(yale_programs[count].text.strip())
        commit_to_sql("Yale University", yale_programs[count].text.strip())
        count += 9


def find_columbia_programs():
    page_being_crawled = 'https://www.college.columbia.edu/academics/programs'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('ul', attrs={'class': 'list-three-col'})
    columbia_programs = list_of_programs.findAll('li')

    count = 1
    while count < len(columbia_programs):
        print(columbia_programs[count].text.strip())
        commit_to_sql("Columbia University", columbia_programs[count].text.strip())
        count += 14


def find_tsinghua_programs():
    page_being_crawled = 'http://www.tsinghua.edu.cn/publish/thu2018en/newthuen_cnt/02-admissions-1.html'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    tsinghua_programs = bs_format.findAll('td', attrs={'class': 'tdborder_t'})

    count = 0
    while count < len(tsinghua_programs):
        if len(tsinghua_programs[count].text.strip()) < 3:
            del tsinghua_programs[count]
        print(tsinghua_programs[count].text.strip())
        commit_to_sql("Tsinghua University", tsinghua_programs[count].text.strip())
        count += 34


def find_edinburgh_programs():
    page_being_crawled = 'https://www.ed.ac.uk/studying/undergraduate/degrees/index.php?action=degreeList'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    edinburgh_programs = bs_format.findAll('a', attrs={'class': 'list-group-item'})

    count = 0
    while count < 0.5*len(edinburgh_programs):
        print(edinburgh_programs[count].text.strip())
        commit_to_sql("Edinburgh University", edinburgh_programs[count].text.strip())
        count += 34


def find_pennsylvania_programs():
    page_being_crawled = 'https://catalog.upenn.edu/programs/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('div', attrs={'class': 'az_sitemap'})
    pennsylvania_programs = list_of_programs.findAll('li')

    count = 0
    while count < len(pennsylvania_programs):
        print(pennsylvania_programs[count].text.strip())
        commit_to_sql("University of Pennsylvania", pennsylvania_programs[count].text.strip())
        count += 60


def find_michigan_programs():
    page_being_crawled = 'https://admissions.umich.edu/academics-majors/majors-degrees'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    michigan_programs = bs_format.findAll('h3')

    count = 0
    while count < len(michigan_programs):
        print(michigan_programs[count].text.strip())
        commit_to_sql("University of Michigan", michigan_programs[count].text.strip())
        count += 19


def find_jhu_programs():
    page_being_crawled = 'https://ep.jhu.edu/programs-and-courses/programs'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    jhu_programs = bs_format.findAll('div', attrs={'class': 'views-field views-field-title'})

    count = 0
    while count < len(jhu_programs):
        print(jhu_programs[count].text.strip())
        commit_to_sql("John Hopkins University", jhu_programs[count].text.strip())
        count += 5


def find_efpl_programs():
    page_being_crawled = 'https://www.epfl.ch/education/bachelor/programs/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    efpl_programs = bs_format.findAll('h3', attrs={'class': 'h4 card-title'})

    count = 0
    while count < len(efpl_programs):
        print(efpl_programs[count].text.strip())
        commit_to_sql("EPFL - Ecole Polytechnique Federale de Lausanne", efpl_programs[count].text.strip())
        count += 3


def find_utokyo_programs():
    page_being_crawled = 'https://www.u-tokyo.ac.jp/en/prospective-students/graduate_course_list.html'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('table', attrs={'height': '1224'})
    utokyo_programs = list_of_programs.findAll('a')
    print(utokyo_programs)

    count = 0
    while count < len(utokyo_programs):
        print(utokyo_programs[count].text.strip())
        commit_to_sql("University of Tokyo", utokyo_programs[count].text.strip())
        count += 6


def find_anu_programs():
    page_being_crawled = 'https://www.hotcoursesabroad.com/india/all-degrees/all-courses-at-the-australian-national-' \
                         'university/864/programs.html#search&smode=&collegeId=864&restRefineFlag=Y&collegeId=864&pa' \
                         'geNo=1&collegeId=864'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    anu_programs = bs_format.findAll('h3')
    print(anu_programs)

    count = 0
    while count < len(anu_programs)-1:
        print(anu_programs[count].text.strip())
        commit_to_sql("Australian National University", anu_programs[count].text.strip())
        count += 3


def find_hku_programs():
    page_being_crawled = 'https://engg.hku.hk/Teaching-Learning/BEng/Academic-Programmes'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('div', attrs={'class': 'inner-content'})
    hku_programs = list_of_programs.findAll('li')

    count = 0
    while count < len(hku_programs) - 1:
        print(hku_programs[count].text.strip())
        commit_to_sql("University of Hong Kong", hku_programs[count].text.strip())
        count += 1

# Main program code after this. Call each function to put the programs list for each respective Uni into the database


print("Database of Programs Updated")
