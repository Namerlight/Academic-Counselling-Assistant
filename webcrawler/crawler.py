from urllib.request import Request, urlopen
from bs4 import BeautifulSoup

page_being_crawled = 'https://www.topuniversities.com/university-rankings/world-university-rankings/2019'

req = Request(page_being_crawled, headers={'User-Agent': 'Mozilla/5.0'})

page_html = urlopen(req).read()

# page_html = urllib.request.urlopen(page_being_crawled)

bs_format = BeautifulSoup(page_html, 'html.parser')

title = bs_format.find('h2', attrs={'class': 'element-invisible'})

test = title.text.strip()

print(test)

# big_table = bs_format.find('table', attrs={'class': 'dataTable no-footer'})

# my_table = big_table[0]
# rows = my_table.findChildren(['tr'])

# for child in rows:
#    print(child)

