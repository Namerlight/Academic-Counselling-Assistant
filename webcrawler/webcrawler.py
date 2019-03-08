import urllib.request
from bs4 import BeautifulSoup

quote_page = ‘www.wikipedia.com'

page = urllib2.urlopen(quote_page)

soup = BeautifulSoup(page, ‘html.parser’)

name_box = soup.find(‘h1’, attrs={‘class’: ‘name’})

