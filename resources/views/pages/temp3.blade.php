@if (($message = Session::get('verificationResponse')))
    <div class="alert alert-success"
         style="width: 30%;margin-left: 35%;margin-top: -3%;border-color: #497652;background-color:#3cff5f ">
        <strong><font color="white" >{!! nl2br(e($message)) !!}</font></strong>
    </div>
@endif

<!--Homepage things-->
<!-- after bulb image src -->

<div>
    <h1><font color="black">Have your own preference ?</font></h1>
</div>


<div class="col-12 col-md-9 mb-2 mb-md-0 autocomplete" style="margin-top: 2%;text-align: left;">
    <font color="black"> <input type="text" class="form-control form-control-lg "
                                placeholder="Program or Country Name"
                                id="filterType"> </font>
</div>
<div class="col-12 col-md-3" style="margin-top: 2%">
    <button type="submit" class="btn btn-block btn-lg btn-primary">Search</button>
</div>

<p class="text-divider" style="width: 50%;margin-left: 24%"><span><font
                color="black">OR</font></span></p>

<div style="margin-top: -3%;margin-left: 27%">

    <h4><font color="black">Let us do it for you!</font></h4>
    <button type="submit" class="btn btn-block btn-lg btn-success">Auto Suggestion</button>
</div>


<a href="{{url('login/google')}}" class="btn btn-block btn-facebook"> <i class="fab fa-google"></i>&nbsp;&nbsp;&nbsp;Fill
                                                                                                   form
                                                                                                   via
                                                                                                   Google</a>


$command = escapeshellcmd('C:\Users\Computer Mania\AppData\Local\Programs\Python\Python37-32\python.exe C:\xampp\htdocs\ACADEMIC_COUNSELLING_ASSISTANT\webcrawler\crawler.py');
$output = shell_exec($command);
echo $output;


// for the merge conflict crawler.py
from urllib.request import Request, urlopen, ftperrors
from bs4 import BeautifulSoup
<<<<<<< HEAD
import mysql.connector
from mysql.connector import Error

=======
>>>>>>> masudurhimel

list_of_names = []
list_of_country = []
list_of_url_names = []

<<<<<<< HEAD
list_of_ranking = []
list_of_avg_price = []
list_of_ownership = []
list_of_student_pop = []
list_of_research = []


def page_crawl_unilist():
page_being_crawled = 'https://www.topuniversities.com/student-info/choosing-university/worlds-top-100-universities'
req = Request(page_being_crawled)
req.add_header('User-Agent', 'Mozilla/5.0')
page_html = urlopen(req)
bs_format = BeautifulSoup(page_html, 'html.parser')
table = bs_format.find('table')
allrows = table.findChild()
for row in allrows:
second_column = row.find('td', attrs={'style': 'width: 455px;'})
uni_names = second_column.text.strip()
list_of_names.append(uni_names)
for row2 in allrows:
third_column = row2.find('td', attrs={'style': 'width: 124px;'})
uni_countries = third_column.text.strip()
list_of_country.append(uni_countries)
del list_of_names[0]
del list_of_country[0]


def generate_url_names():
to_replace = {" of", "in ", " at", ",", " -", "'", " and", " &", "(", ")"}
for name in list_of_names:
nm = name.lower()
for word in to_replace:
nm = nm.replace(word, '')
nm = nm.replace(' ste ', ' state ')
nm = nm.replace(' ', '-')
nm = nm.replace('universität', 'universitat')
nm = nm.replace('münchen', 'munchen')
list_of_url_names.append(nm)

def crawl_uni_info():
unilistIter = 0
for url_uni_name in list_of_url_names[0:5]:
uni_page_url = 'https://www.topuniversities.com/universities/' + url_uni_name
reqe = Request(uni_page_url)
reqe.add_header('User-Agent', 'Mozilla/5.0')
try:
uni_page_html = urlopen(reqe)
except ftperrors():
print("", end='')
continue
uni_bs_format = BeautifulSoup(uni_page_html, 'html.parser')
uni_stats_txt = uni_bs_format.find('div', class_='uni_stats').prettify()
bs_f = BeautifulSoup(uni_stats_txt, 'html.parser')
rank_label = bs_f.findAll('label')
uni_rank = bs_f.findAll('div', attrs={'class': 'val'})
listIter = 0
print(list_of_names[unilistIter], end=' | ')
print(list_of_country[unilistIter], end=' | ')
while listIter < 5:
listIter = 0
if rank_label[listIter].text.strip() == 'QS Global World Ranking':
list_of_ranking.append(uni_rank[listIter].text.strip())
print(uni_rank[listIter].text.strip(), end=' | ')
listIter = 1

if rank_label[listIter].text.strip() == 'Average Fees (USD)':
print(uni_rank[listIter].text.strip(), end=' | ')
list_of_avg_price.append(uni_rank[listIter].text.strip())
listIter = 2
else:
print(" ", end=' | ')
list_of_avg_price.append("")

if rank_label[listIter].text.strip() == 'Status':
print(uni_rank[listIter].text.strip(), end=' | ')
list_of_ownership.append(uni_rank[listIter].text.strip())
listIter = 3
else:
print(" ", end=' | ')
list_of_ownership.append("")

if rank_label[listIter].text.strip() == 'Research Output':
print(uni_rank[listIter].text.strip(), end=' | ')
list_of_research.append(uni_rank[listIter].text.strip())
listIter = 4
else:
print(" ", end=' | ')
list_of_research.append("")

if rank_label[listIter].text.strip() == 'Total Students':
print(uni_rank[listIter].text.strip(), end=' | ')
list_of_student_pop.append(uni_rank[listIter].text.strip())
listIter = 5
else:
print(" ", end=' | ')
list_of_student_pop.append("")

print('\n', end='')
unilistIter += 1

page_crawl_unilist()
generate_url_names()
crawl_uni_info()

try:
connection = mysql.connector.connect(
host='localhost',
database='aca',
user='root',
password='')
if connection.is_connected():
db_Info = connection.get_server_info()
print("Connected to MySQL database... MySQL Server version on ", db_Info)
cursor = connection.cursor()
cursor.execute("select database()")
record = cursor.fetchone()
print("You're connected to", record)
except Error as e:
print("Error while connecting to MySQL", e)

cursor = connection.cursor()

sql = "INSERT INTO universities(qs_ranking, name) VALUES (%s, %s)"
val = (list_of_ranking[0], list_of_names[0])

cursor.execute(sql, val)

connection.commit()

print(cursor.rowcount, "record inserted.")


=======
page_being_crawled = 'https://www.topuniversities.com/student-info/choosing-university/worlds-top-100-universities'
req = Request(page_being_crawled)
req.add_header('User-Agent', 'Mozilla/5.0')

page_html = urlopen(req)
bs_format = BeautifulSoup(page_html, 'html.parser')

table = bs_format.find('table')
allrows = table.findChild()

for row in allrows:
second_column = row.find('td', attrs={'style': 'width: 455px;'})
uni_names = second_column.text.strip()
list_of_names.append(uni_names)

for row2 in allrows:
third_column = row2.find('td', attrs={'style': 'width: 124px;'})
uni_countries = third_column.text.strip()
list_of_country.append(uni_countries)

del list_of_names[0]
del list_of_country[0]

to_replace = {" of", "in ", " at", ",", " -", "'", " and", " &", "(", ")"}

for name in list_of_names:
nm = name.lower()
for word in to_replace:
nm = nm.replace(word, '')
nm = nm.replace(' ste ', ' state ')
nm = nm.replace(' ', '-')
nm = nm.replace('universität', 'universitat')
nm = nm.replace('münchen', 'munchen')
list_of_url_names.append(nm)

for name in list_of_url_names:
print(name)

unilistIter = 0

for url_uni_name in list_of_url_names:

uni_page_url = 'https://www.topuniversities.com/universities/' + url_uni_name
reqe = Request(uni_page_url)
reqe.add_header('User-Agent', 'Mozilla/5.0')

try:
uni_page_html = urlopen(reqe)
except ftperrors():
print("", end='')
continue

uni_bs_format = BeautifulSoup(uni_page_html, 'html.parser')
uni_stats_txt = uni_bs_format.find('div', class_='uni_stats').prettify()
bs_f = BeautifulSoup(uni_stats_txt, 'html.parser')
uni_rank = bs_f.findAll('div', attrs={'class': 'val'})

listIter = 0

print(list_of_names[unilistIter], end=' | ')
print(list_of_country[unilistIter], end=' | ')

while listIter < 5:
print(uni_rank[listIter].text.strip(), end=' | ')
listIter += 1

print('\n', end='')
unilistIter += 1
>>>>>>> masudurhimel

<nav class="navbar navbar-expand-md navbar-dark bg-info" style="height: 12%;width: 100%;margin-top: 6%;margin-left: -10%">
    <p class=" col-xl-2 mx-auto" style="text-align: center;font-size: 20px"><b>Course Matching Tool</b></p>
</nav>