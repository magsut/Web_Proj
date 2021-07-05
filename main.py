import os
import time
from bs4 import BeautifulSoup
from selenium import webdriver

p = open("num.txt", 'r', encoding="utf-8")
x = p.readline()
p.close()
if x == "Invalid number":
    f = open('num.txt', 'w', encoding="utf-8")
    f.write("Некорректный номер")
else:
    y = (r'https://auto.ru/history/' + x + '/')

    chromedriver = 'chromedriver'
    options = webdriver.ChromeOptions()
    #options.add_argument('headless')

    browser = webdriver.Chrome(executable_path=chromedriver, options=options)
    browser.get(y)

    time.sleep(15)
    browser.close()

    browser = webdriver.Chrome(executable_path=chromedriver, options=options)
    browser.get(y)
    time.sleep(1)
    requiredHtml = browser.page_source

    soup = BeautifulSoup(requiredHtml, 'html.parser')
    name = soup.find('div', class_='VinReportPreviewExp__mmm').text
    print(name)
    browser.close()
    f = open('name.txt', 'w', encoding="utf-8")
    f.write(name)
    f.close()
