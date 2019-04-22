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
sql0 = "CREATE TABLE IF NOT EXISTS university_programs (uni_prog_id INT NOT NULL AUTO_INCREMENT, university_name VARCHAR(199), program_name VARCHAR(199), GRE_reqs VARCHAR(199), ielts_reqs VARCHAR(199), PRIMARY KEY (uni_prog_id))"
cursor.execute(sql0)
connection.commit()

# Removing outdated data in order to be replaced with newer data
sql1 = "DELETE FROM university_programs"
cursor.execute(sql1)
connection.commit()

# Resetting the auto incrementation to 1
sql2 = "ALTER TABLE university_programs AUTO_INCREMENT = 1"
cursor.execute(sql2)
connection.commit()


# Places crawled data into the sql database, in universities_programs table
# Uni Name is manually in code, programs list is scraped and is in the form of a list item
def commit_to_sql(uni_name, programs_list):
    sql = "INSERT INTO university_programs (university_name, program_name) " \
          "VALUES (%s, %s)"
    val = (uni_name, programs_list)
    cursor.execute(sql, val)
    connection.commit()

# Searches database for the university name that corresponds to an id
# The name is placed in uni_name, extra parts of the string are removed
def fetch_uni_name(uni_id):
    sql = "SELECT name FROM universities WHERE id = %s"
    cursor.execute(sql, (uni_id, ))
    uni_name = str(cursor.fetchone())
    uni_name = uni_name.replace('(\'', '')
    uni_name = uni_name.replace('\',)', '')
    return uni_name


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
    while count < len(mit_programs):
        print(mit_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(1), mit_programs[count].text.strip())
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
        commit_to_sql(fetch_uni_name(2), harvard_programs[count].text.strip())
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
            commit_to_sql(fetch_uni_name(3), stanford_programs[count].text.strip())
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
        commit_to_sql(fetch_uni_name(4), caltech_programs[count].text.strip())
        count += 6


def find_oxford_programs():
    page_being_crawled = 'https://www.ox.ac.uk/admissions/undergraduate/colleges/which-oxford-colleges-offer-my-' \
                         'course?wssl=1#'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    oxford_programs = bs_format.findAll('h3')

    count = 0
    while count < len(oxford_programs):
        print(oxford_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(5), oxford_programs[count].text.strip())
        count += 7


def find_cambridge_programs():
    page_being_crawled = 'https://www.undergraduate.study.cam.ac.uk/courses'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')

    cambridge_programs = bs_format.findAll('h4')

    count = 0
    while count < len(cambridge_programs):
        print(cambridge_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(6), cambridge_programs[count].text.strip())
        count += 6


def find_ethzurich_programs():
    page_being_crawled = 'https://www.ethz.ch/students/en/studies/degree-programmes.html'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.findAll('div', attrs={'class': 'reference'})
    ethzurich_programs = list_of_programs[1].findAll('li', attrs={})

    count = 0
    while count < len(ethzurich_programs):
        print(ethzurich_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(7), ethzurich_programs[count].text.strip())
        count += 1


def find_icl_programs():
    page_being_crawled = 'https://www.imperial.ac.uk/study/ug/courses/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')

    icl_programs = bs_format.findAll('h4', attrs={'class': 'title'})

    count = 1
    while count < len(icl_programs):
        print(icl_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(8), icl_programs[count].text.strip())
        count += 17


def find_chicago_programs():
    page_being_crawled = 'http://physical-sciences.uchicago.edu/page/academic-departments-and-programs'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')

    list_of_programs = bs_format.findAll('ul')
    chicago_programs = list_of_programs[3].findAll('li')

    count = 1
    while count < len(chicago_programs):
        print(chicago_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(9), chicago_programs[count].text.strip())
        count += 1


def find_ucl_programs():
    page_being_crawled = 'https://www.ucl.ac.uk/digital-presence-services/pgtaught/www/degreesearch.php'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    ucl_programs = bs_format.findAll('a', attrs={'target': '_top'})
    print(ucl_programs)

    count = 1
    while count < len(ucl_programs):
        print(ucl_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(10), ucl_programs[count].text.strip())
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
        commit_to_sql(fetch_uni_name(11), nus_programs[count].text.strip())
        count += 10


def find_ntu_programs():
    page_being_crawled = 'https://www.ntu.edu.sg/Academics/Pages/UndergraduateProgrammes.aspx'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')

    ntu_programs = bs_format.findAll('a', attrs={'href': '/#'})

    count = 0
    while count < len(ntu_programs):
        print(ntu_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(12), ntu_programs[count].text.strip())
        count += 4


def find_princeton_programs():
    page_being_crawled = 'https://admission.princeton.edu/academics/degrees-departments'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')

    princeton_programs = bs_format.findAll('strong')

    count = 1
    while count < len(princeton_programs):
        print(princeton_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(13), princeton_programs[count].text.strip())
        count += 6


def find_cornell_programs():
    page_being_crawled = 'https://www.cornell.edu/academics/fields.cfm'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    cornell_programs = bs_format.findAll('a', attrs={'aria-describedby': 'majors'})

    count = 0
    while count < len(cornell_programs):
        print(cornell_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(14), cornell_programs[count].text.strip())
        count += 12


def find_yale_programs():
    page_being_crawled = 'http://catalog.yale.edu/ycps/majors-in-yale-college/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    yale_programs = bs_format.findAll('p', attrs={'class': 'hangindent'})
    print(yale_programs)

    count = 1
    while count < len(yale_programs):
        print(yale_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(15), yale_programs[count].text.strip())
        count += 9


def find_columbia_programs():
    page_being_crawled = 'https://www.college.columbia.edu/academics/programs'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('ul', attrs={'class': 'list-three-col'})
    columbia_programs = list_of_programs.findAll('li')

    count = 1
    while count < len(columbia_programs):
        print(columbia_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(16), columbia_programs[count].text.strip())
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
        commit_to_sql(fetch_uni_name(17), tsinghua_programs[count].text.strip())
        count += 34


def find_edinburgh_programs():
    page_being_crawled = 'https://www.ed.ac.uk/studying/undergraduate/degrees/index.php?action=degreeList'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    edinburgh_programs = bs_format.findAll('a', attrs={'class': 'list-group-item'})

    count = 0
    while count < 0.5*len(edinburgh_programs):
        print(edinburgh_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(18), edinburgh_programs[count].text.strip())
        count += 34


def find_pennsylvania_programs():
    page_being_crawled = 'https://catalog.upenn.edu/programs/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('div', attrs={'class': 'az_sitemap'})
    pennsylvania_programs = list_of_programs.findAll('li')

    count = 0
    while count < len(pennsylvania_programs):
        print(pennsylvania_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(19), pennsylvania_programs[count].text.strip())
        count += 60


def find_michigan_programs():
    page_being_crawled = 'https://admissions.umich.edu/academics-majors/majors-degrees'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    michigan_programs = bs_format.findAll('h3')

    count = 0
    while count < len(michigan_programs):
        print(michigan_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(20), michigan_programs[count].text.strip())
        count += 19


def find_jhu_programs():
    page_being_crawled = 'https://ep.jhu.edu/programs-and-courses/programs'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    jhu_programs = bs_format.findAll('div', attrs={'class': 'views-field views-field-title'})

    count = 0
    while count < len(jhu_programs):
        print(jhu_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(21), jhu_programs[count].text.strip())
        count += 5


def find_efpl_programs():
    page_being_crawled = 'https://www.epfl.ch/education/bachelor/programs/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    efpl_programs = bs_format.findAll('h3', attrs={'class': 'h4 card-title'})

    count = 0
    while count < len(efpl_programs):
        print(efpl_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(22), efpl_programs[count].text.strip())
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
        commit_to_sql(fetch_uni_name(23), utokyo_programs[count].text.strip())
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
        commit_to_sql(fetch_uni_name(24), anu_programs[count].text.strip())
        count += 3


def find_hku_programs():
    page_being_crawled = 'https://engg.hku.hk/Teaching-Learning/BEng/Academic-Programmes'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('div', attrs={'class': 'inner-content'})
    hku_programs = list_of_programs.findAll('li')

    count = 0
    while count < len(hku_programs) - 1:
        print(hku_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(25), hku_programs[count].text.strip())
        count += 1


def find_duke_programs():
    page_being_crawled = 'https://admissions.duke.edu/education/majors'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('div', attrs={'class': 'grid-cell'})
    duke_programs = list_of_programs.findAll('li')

    count = 0
    while count < len(duke_programs):
        print(duke_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(26), duke_programs[count].text.strip())
        count += 11


def find_ucb_programs():
    page_being_crawled = 'http://guide.berkeley.edu/undergraduate/degree-programs/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    ucb_programs = bs_format.findAll('a', attrs={'class': 'pview'})

    count = 6
    while count < len(ucb_programs):
        print(ucb_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(27), ucb_programs[count].text.strip())
        count += 25


def find_toronto_programs():
    page_being_crawled = 'https://www.utoronto.ca/academics/programs-directory/all'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    toronto_programs = bs_format.findAll('h4')

    count = 30
    while count < len(toronto_programs):
        print(toronto_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(28), toronto_programs[count].text.strip())
        count += 35


def find_manchester_programs():
    page_being_crawled = 'https://www.manchester.ac.uk/study/undergraduate/courses/2020/?k=Computer%20Science'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('select', attrs={'id': 'subject-area'})
    manchester_programs = list_of_programs.findAll('option')

    count = 1
    while count < len(manchester_programs):
        print(manchester_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(29), manchester_programs[count].text.strip())
        count += 15


def find_peking_programs():
    page_being_crawled = 'http://www.isd.pku.edu.cn/info/1465/5616.htm'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    peking_programs = bs_format.findAll('td', attrs={'width': '308'})

    count = 1
    while count < len(peking_programs):
        print(peking_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(30), peking_programs[count].text.strip())
        count += 10


def find_kcl_programs():
    page_being_crawled = 'https://www.kcl.ac.uk/aboutkings/quality/academic/prog/specs/nms/2018-19/informaticscusp'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('div', attrs={'id': 'content_column'})
    kcl_programs = list_of_programs.findAll('li')

    count = 1
    while count < len(kcl_programs):
        print(kcl_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(31), kcl_programs[count].text.strip())
        count += 7


def find_ucla_programs():
    page_being_crawled = 'http://www.ucla.edu/academics/departments-and-programs'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('div', attrs={'id': 'main-content'})
    ucla_programs = list_of_programs.findAll('a')

    count = 2
    while count < len(ucla_programs):
        if len(ucla_programs[count].text.strip()) > 1:
            print(ucla_programs[count].text.strip())
            commit_to_sql(fetch_uni_name(32), ucla_programs[count].text.strip())
        count += 24


def find_mcgill_programs():
    page_being_crawled = 'https://www.mcgill.ca/undergraduate-admissions/programs'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    mcgill_programs = bs_format.findAll('div', attrs={'class': 'content'})

    count = 0
    while count < len(mcgill_programs):
        print(mcgill_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(33), mcgill_programs[count].text.strip())
        count += 45


def find_northwestern_programs():
    page_being_crawled = 'https://www.tgs.northwestern.edu/academics/programs/index.html'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('table', attrs={'id': 'programs'})
    northwestern_programs = list_of_programs.findAll('tr')

    count = 1
    while count < len(northwestern_programs):
        print(northwestern_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(34), northwestern_programs[count].text.strip())
        count += 20


def find_kyoto_programs():
    page_being_crawled = 'http://www.opir.kyoto-u.ac.jp/study/en/curriculum/inenglish/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    kyoto_programs = bs_format.findAll('a', attrs={'target': '_blank'})

    count = 1
    while count < len(kyoto_programs):
        print(kyoto_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(35), kyoto_programs[count].text.strip())
        count += 3


def find_snu_programs():
    page_being_crawled = 'http://www.useoul.edu/undergraduate-programs?cid=106'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('ul', attrs={'class': 'deptlist'})
    snu_programs = list_of_programs.findAll('li')

    count = 0
    while count < len(snu_programs):
        print(snu_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(36), snu_programs[count].text.strip())
        count += 3


def find_hkust_programs():
    page_being_crawled = 'https://join.ust.hk/undergraduate/school-of-engineering/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('div', attrs={'class': 'entry-content'})
    hkust_programs = list_of_programs.findAll('li')

    count = 6
    while count < len(hkust_programs):
        print(hkust_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(37), hkust_programs[count].text.strip())
        count += 4


def find_lse_programs():
    page_being_crawled = 'http://www.lse.ac.uk/Programmes/Search-Courses?query&f.Study+Type%7Ctype=undergraduate'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    lse_programs = bs_format.findAll('h1', attrs={'class': 'largeList__title'})

    count = 0
    while count < len(lse_programs):
        print(lse_programs[count].text.strip()[43:])
        commit_to_sql(fetch_uni_name(38), lse_programs[count].text.strip())
        count += 2


def find_unimelb_programs():
    page_being_crawled = 'https://study.unimelb.edu.au/find/interests/engineering/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('ul', attrs={'class': 'grid'})
    unimelb_programs = list_of_programs.findAll('span', attrs={'class': 'course-item__name'})

    count = 10
    while count < len(unimelb_programs):
        print(unimelb_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(39), unimelb_programs[count].text.strip())
        count += 5


def find_kaist_programs():
    page_being_crawled = 'https://engineering.kaist.ac.kr/education/department'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    kaist_programs = bs_format.findAll('dt')

    count = 22
    while count < len(kaist_programs)-1:
        print(kaist_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(40), kaist_programs[count].text.strip())
        count += 2


def find_ucsd_programs():
    page_being_crawled = 'https://apply.grad.ucsd.edu/masters-programs#b-s-m-s-bs-ms'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    ucsd_programs = bs_format.findAll('a')

    count = 64
    while count < len(ucsd_programs)-1:
        print(ucsd_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(41), ucsd_programs[count].text.strip())
        count += 10


def find_usydney_programs():
    page_being_crawled = 'https://sydney.edu.au/engineering/study-engineering-and-it/' \
                         'postgraduate-coursework-degrees.html'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    usydney_programs = bs_format.findAll('h3')

    count = 0
    while count < len(usydney_programs)-3:
        print(usydney_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(42), usydney_programs[count].text.strip())
        count += 1


def find_nyu_programs():
    page_being_crawled = 'https://engineering.nyu.edu/academics/programs/master-science'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    nyu_programs = bs_format.findAll('span', attrs={'class': 'field field--name-title field--type-string '
                                                             'field--label-hidden'})

    count = 1
    while count < len(nyu_programs)-3:
        print(nyu_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(43), nyu_programs[count].text.strip())
        count += 4

def find_fudan_programs():
    return 0

def find_unsw_programs():
    page_being_crawled = 'https://www.international.unsw.edu.au/faculty/engineering-postgraduate-degree-programs'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    unsw_programs = bs_format.findAll('h5', attrs={'class': 'degree-title'})

    count = 1
    while count < len(unsw_programs) - 3:
        print(unsw_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(45), unsw_programs[count].text.strip())
        count += 10


def find_cmu_programs():
    page_being_crawled = 'https://www.cmu.edu/graduate/academics/guide-to-graduate-degrees-and-programs/index.html'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    cmu_programs = bs_format.findAll('li')

    count = 1
    while count < len(cmu_programs) - 120:
        print(cmu_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(46), cmu_programs[count].text.strip())
        count += 10



def find_ubc_programs():
    page_being_crawled = 'https://www.grad.ubc.ca/prospective-students/graduate-degree-programs'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    ubc_programs = bs_format.findAll('h4')

    count = 1
    while count < len(ubc_programs):
        print(ubc_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(47), ubc_programs[count].text.strip())
        count += 3


def find_uq_programs():
    page_being_crawled = 'https://my.uq.edu.au/programs-courses/browse.html?level=pgpg'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    uq_programs = bs_format.findAll('td', attrs={'class': 'plan'})

    count = 1
    while count < len(uq_programs):
        print(uq_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(48), uq_programs[count].text.strip())
        count += 54


def find_cuhk_programs():
    page_being_crawled = 'https://www.gs.cuhk.edu.hk/admissions/programme/engineering'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    cuhk_programs = bs_format.findAll('a', attrs={'data-ix': 'taught-programmes'})

    count = 1
    while count < len(cuhk_programs):
        print(cuhk_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(49), cuhk_programs[count].text.strip())
        count += 2


def find_psl_programs():
    page_being_crawled = 'https://www.psl.eu/en/formations?field_discipline=&domaine%5B28%5D=28&field_mots_cles='
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.findAll('a', attrs={'class': 'formation_row'})

    count = 0
    while count < len(list_of_programs):
        psl_programs = list_of_programs[count].findAll('div', attrs={'class': 'col'})
        print(psl_programs[1].text.strip())
        commit_to_sql(fetch_uni_name(50), psl_programs[1].text.strip())
        count += 3


def find_bristol_programs():
    page_being_crawled = 'http://www.bristol.ac.uk/study/postgraduate/search/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('ul', attrs={'class': 'list-no-style list-half-spacing prog-results-list'})
    bristol_programs = list_of_programs.findAll('li')

    count = 1
    while count < len(bristol_programs):
        print(bristol_programs[count].find('a').text.strip())
        commit_to_sql(fetch_uni_name(51), bristol_programs[count].find('a').text.strip())
        count += 6


def find_delft_programs():
    page_being_crawled = 'https://www.tudelft.nl/en/education/programmes/masters/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    delft_programs = bs_format.findAll('h4', attrs={'class': 'h3'})

    count = 1
    while count < len(delft_programs):
        print(delft_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(52), delft_programs[count].text.strip())
        count += 6


def find_uwmad_programs():
    page_being_crawled = 'https://grad.wisc.edu/academic-programs/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    list_of_programs = bs_format.find('ul', attrs={'class': 'mas-list'})
    uwmad_programs = list_of_programs.findAll('a')

    count = 6
    while count < len(uwmad_programs):
        print(uwmad_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(53), uwmad_programs[count].text.strip())
        count += 55


def find_warwick_programs():
    page_being_crawled = 'https://warwick.ac.uk/study/postgraduate/courses-2019/'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    warwick_programs = bs_format.findAll('h6')

    count = 6
    while count < len(warwick_programs):
        print(warwick_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(54), warwick_programs[count].text.strip())
        count += 30


def find_cityuhk_programs():
    return 0


def find_brown_programs():
    page_being_crawled = 'https://www.brown.edu/graduate_programs'
    bs_format = BeautifulSoup(find_page_html(page_being_crawled), 'html.parser')
    brown_programs = bs_format.findAll('h3', attrs={'class': 'component_title'})

    count = 30
    while count < len(brown_programs):
        print(brown_programs[count].text.strip())
        commit_to_sql(fetch_uni_name(56), brown_programs[count].text.strip())
        count += 10

#For new university programs things will be added here

# Main program code after this. Call each function to put the programs list for each respective Uni into the database


find_mit_programs()
find_harvard_programs()
find_stanford_programs()
find_caltech_programs()
find_oxford_programs()
find_cambridge_programs()
find_ntu_programs()
find_ethzurich_programs()
find_princeton_programs()
find_icl_programs()
find_chicago_programs()
find_ucl_programs()
find_nus_programs()
find_cornell_programs()
find_yale_programs()
find_columbia_programs()
find_tsinghua_programs()
find_edinburgh_programs()
find_pennsylvania_programs()
#find_michigan_programs()
find_jhu_programs()
find_efpl_programs()
find_utokyo_programs()
find_anu_programs()
find_hku_programs()
find_duke_programs()
find_ucb_programs()
find_toronto_programs()
find_manchester_programs()
find_peking_programs()
find_kcl_programs()
find_ucla_programs()
find_hkust_programs()
find_mcgill_programs()
find_northwestern_programs()
find_kyoto_programs()
find_snu_programs()
find_hkust_programs()
find_lse_programs()
find_unimelb_programs()
find_kaist_programs()
find_ucsd_programs()
find_usydney_programs()
find_nyu_programs()
find_unsw_programs()
find_cmu_programs()
find_ubc_programs()
find_uq_programs()
#find_cuhk_programs()
find_psl_programs()
find_bristol_programs()
find_delft_programs()
find_uwmad_programs()
find_warwick_programs()
find_cityuhk_programs()
find_brown_programs()

print("\n<<Database of Programs Updated>>")




