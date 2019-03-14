from urllib.request import Request, urlopen
from bs4 import BeautifulSoup

# page_being_crawled = 'https://www.topuniversities.com/university-rankings/world-university-rankings/2019'
# req = Request(page_being_crawled, headers={'User-Agent': 'Mozilla/5.0'})
# page_html = urlopen(req).read()

page_being_crawled = 'https://www.timeshighereducation.com/world-university-rankings/2019/' \
                     'world-ranking#!/page/0/length/100/sort_by/rank/sort_order/asc/cols/stats'

page_html = urlopen(page_being_crawled)

bs_format = BeautifulSoup(page_html, 'html.parser')

title = bs_format.find('h1', attrs={'class': 'pane-title'})

test = title.text.strip()

print(test)

table = bs_format.find('table', id='datatable-1')

name1 = table.find('a', attrs={'class': 'ranking-institution-title'})

tablebody = table.find('tbody')

row1 = tablebody.find('tr', role='row')

name2 = table.find('td', attrs={'class': 'name namesearch'})

# <a class="ranking-institution-title" href="/world-university-rankings/university-oxford" data-position="title" data-mz="">University of Oxford</a>

data1 = tablebody.find('a', attrs={'class': "ranking-institution-title", 'data-position': "title"})

print(table)

print(row1)
print(name1)
print(data1)
