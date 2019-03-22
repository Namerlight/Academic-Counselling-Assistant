from urllib.request import Request, urlopen, ftperrors
from bs4 import BeautifulSoup

list_of_names = []
list_of_country = []
list_of_url_names = []

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

    while listIter < 5:
        print(uni_rank[listIter].text.strip(), end=' | ')
        listIter += 1

    print('\n', end='')
    unilistIter += 1

