# encoding: utf-8
import requests
import re
from bs4 import BeautifulSoup
import time
import pymysql.cursors

class News:
    def __init__(self,title,time,type,content):
        self.title = title  #新闻标题
        self.time = time    #新闻时间
        self.type = type    #新闻类别
        self.content = content  #新闻内容

def getList(url):   #获取新闻链接地址
    li = requests.get(url)      
    res = r'url":"http:.*?.html'    #正则表达式获取链接地址
    urls = re.findall(res,li.text)
    for i in range(len(urls)):
        urls[i] = urls[i][6:]  #截取URL的第六个字符之后的内容并保留 
    return urls

def getNews(url):   #获取新闻内容
#   特殊处理链接，获取全文，加了_0   
#   str[:-5] 截取从头开始到倒数第五个字符之前，指.html
    url = url[:-5]+"_0.html"    
    ss = requests.get(url)
#   获取新闻内容
    soup = BeautifulSoup(ss.text,"html.parser") 
#   str[:-6] 截取从头开始到倒数第六个字符之前 -新闻标题
    title = soup.title.string[:-6].encode('utf-8')
    print(title)      
#   str[9:] 截取第九个字符到结尾 -新闻时间
    time = soup.find("div","about").contents[0][9:].encode('utf-8')
    if 3 < len(soup.find("div","position lBlue").contents):
    	type = soup.find("div","position lBlue").contents[3].string.encode('utf-8')
    else:
    	type = soup.find("div","position lBlue").contents[1].string.encode('utf-8')
#   str[3] 截取第三个字符 -新闻类型
#   contents[1]是来源
    print(type)
#   截取全文内容 -新闻内容
    content = soup.find("div","content").get_text()[1:-1].encode('utf-8')
    # print(content)
#   封装
    news = News(title,time,type,content)
    return news






def saveAsSQL(news, id, what):
    config = {
          'host':'127.0.0.1',
          'port':3306,
          'user':'root',
          'password':'',
          'db':'Mynews',
          'charset':'utf8mb4',
          'cursorclass':pymysql.cursors.DictCursor,
          }
    connection = pymysql.connect(**config)
    try:
        with connection.cursor() as cursor:
            sql = "INSERT INTO %s" % what + " (news_id, title, time, content, type) VALUES (%s, %s, %s, %s, %s)"
            cursor.execute(sql, (id, news.title, news.time, news.content, news.type));
        connection.commit()
    finally:
        connection.close();

def clearSQL(what):
    config = {
          'host':'127.0.0.1',
          'port':3306,
          'user':'root',
          'password':'',
          'db':'Mynews',
          'charset':'utf8mb4',
          'cursorclass':pymysql.cursors.DictCursor,
          }
    connection = pymysql.connect(**config)
    try:
        with connection.cursor() as cursor:
            sql = "DELETE FROM %s WHERE 1 " % what
            cursor.execute(sql);
        connection.commit()
    finally:
        connection.close();

# id = 1
# start = time.clock()
# sum = 0
# #获取前40页新闻
# for i in range(1,10):
#     net = "http://3g.163.com/touch/article/list/BAI67OGGwangning/%s-10.html" %i
# #   获取新闻列表
#     urls = getList(net)
# #   求和sum
#     sum = sum + len(urls)
# #   print "当前页解析出 %s 条" %len(urls)
#     j = 1
# #   对当前页面的每一条新闻获取URL
#     for url in urls:
#         print "正在读取第%s页第%s/%s条:%s" %(i,j,len(urls),url.encode('utf-8'))
#         try:
#         	news = getNews(url)
#         	saveAsSQL(news, id, 'militarynews')
#         	id = id +1
#         	j = j + 1
#         except Exception as e:
#         	pass
#         finally:
#         	pass
# end = time.clock()
# print "共爬取网易军事%s条新闻，耗时%f s" %(sum,end - start)



# id = 1
# start = time.clock()
# sum = 0
# #获取前40页新闻
# for i in range(1,10):
#     net = "http://3g.163.com/touch/article/list/BA10TA81wangning/%s-10.html" %i
# #   获取新闻列表
#     urls = getList(net)
# #   求和sum
#     sum = sum + len(urls)
# #   print "当前页解析出 %s 条" %len(urls)
#     j = 1
# #   对当前页面的每一条新闻获取URL
#     for url in urls:
#         print "正在读取第%s页第%s/%s条:%s" %(i,j,len(urls),url.encode('utf-8'))
#         try:
#         	news = getNews(url)
#         	saveAsSQL(news, id, 'entertainmentnews')
#         	id = id +1
#         	j = j + 1
#         except Exception as e:
#         	pass
#         finally:
#         	pass
# end = time.clock()
# print "共爬取网易娱乐%s条新闻，耗时%f s" %(sum,end - start)

# id = 1
# start = time.clock()
# sum = 0
# #获取前40页新闻
# for i in range(1,10):
#     net = "http://3g.163.com/touch/article/list/BA8E6OEOwangning/%s-10.html" %i
# #   获取新闻列表
#     urls = getList(net)
# #   求和sum
#     sum = sum + len(urls)
# #   print "当前页解析出 %s 条" %len(urls)
#     j = 1
# #   对当前页面的每一条新闻获取URL
#     for url in urls:
#         print "正在读取第%s页第%s/%s条:%s" %(i,j,len(urls),url.encode('utf-8'))
#         try:
#         	news = getNews(url)
#         	saveAsSQL(news, id, 'sportsnews')
#         	id = id +1
#         	j = j + 1
#         except Exception as e:
#         	pass
#         finally:
#         	pass
# end = time.clock()
# print "共爬取网易体育%s条新闻，耗时%f s" %(sum,end - start)


# id = 1
# start = time.clock()
# sum = 0
# #获取前40页新闻
# for i in range(1,10):
#     net = "http://3g.163.com/touch/article/list/BA8EE5GMwangning/%s-10.html" %i
# #   获取新闻列表
#     urls = getList(net)
# #   求和sum
#     sum = sum + len(urls)
# #   print "当前页解析出 %s 条" %len(urls)
#     j = 1
# #   对当前页面的每一条新闻获取URL
#     for url in urls:
#         print "正在读取第%s页第%s/%s条:%s" %(i,j,len(urls),url.encode('utf-8'))
#         try:
#         	news = getNews(url)
#         	saveAsSQL(news, id, 'economynews')
#         	id = id +1
#         	j = j + 1
#         except Exception as e:
#         	pass
#         finally:
#         	pass
# end = time.clock()
# print "共爬取网易财经%s条新闻，耗时%f s" %(sum,end - start)


# id = 1
# start = time.clock()
# sum = 0
# #获取前40页新闻
# for i in range(1,10):
#     net = "http://3g.163.com/touch/article/list/BAI6I0O5wangning/%s-10.html" %i
# #   获取新闻列表
#     urls = getList(net)
# #   求和sum
#     sum = sum + len(urls)
# #   print "当前页解析出 %s 条" %len(urls)
#     j = 1
# #   对当前页面的每一条新闻获取URL
#     for url in urls:
#         print "正在读取第%s页第%s/%s条:%s" %(i,j,len(urls),url.encode('utf-8'))
#         try:
#         	news = getNews(url)
#         	saveAsSQL(news, id, 'phonenews')
#         	id = id +1
#         	j = j + 1
#         except Exception as e:
#         	pass
#         finally:
#         	pass
# end = time.clock()
# print "共爬取网易手机%s条新闻，耗时%f s" %(sum,end - start)

# id = 1
# start = time.clock()
# sum = 0
# #获取前40页新闻
# for i in range(1,10):
#     net = "http://3g.163.com/touch/article/list/BA8D4A3Rwangning/%s-10.html" %i
# #   获取新闻列表
#     urls = getList(net)
# #   求和sum
#     sum = sum + len(urls)
# #   print "当前页解析出 %s 条" %len(urls)
#     j = 1
# #   对当前页面的每一条新闻获取URL
#     for url in urls:
#         print "正在读取第%s页第%s/%s条:%s" %(i,j,len(urls),url.encode('utf-8'))
#         try:
#         	news = getNews(url)
#         	saveAsSQL(news, id, 'technologynews')
#         	id = id +1
#         	j = j + 1
#         except Exception as e:
#         	pass
#         finally:
#         	pass
# end = time.clock()
# print "共爬取网易科技%s条新闻，耗时%f s" %(sum,end - start)

# id = 1
# start = time.clock()
# sum = 0
# #获取前40页新闻
# for i in range(1,10):
#     net = "http://3g.163.com/touch/article/list/BAI6RHDKwangning/%s-10.html" %i
# #   获取新闻列表
#     urls = getList(net)
# #   求和sum
#     sum = sum + len(urls)
# #   print "当前页解析出 %s 条" %len(urls)
#     j = 1
# #   对当前页面的每一条新闻获取URL
#     for url in urls:
#         print "正在读取第%s页第%s/%s条:%s" %(i,j,len(urls),url.encode('utf-8'))
#         try:
#         	news = getNews(url)
#         	saveAsSQL(news, id, 'gamesnews')
#         	id = id +1
#         	j = j + 1
#         except Exception as e:
#         	pass
#         finally:
#         	pass
# end = time.clock()
# print "共爬取网易游戏%s条新闻，耗时%f s" %(sum,end - start)


# id = 1
# start = time.clock()
# sum = 0
# #获取前40页新闻
# for i in range(1,10):
#     net = "http://3g.163.com/touch/article/list/BA8FF5PRwangning/%s-10.html" %i
# #   获取新闻列表
#     urls = getList(net)
# #   求和sum
#     sum = sum + len(urls)
# #   print "当前页解析出 %s 条" %len(urls)
#     j = 1
# #   对当前页面的每一条新闻获取URL
#     for url in urls:
#         print "正在读取第%s页第%s/%s条:%s" %(i,j,len(urls),url.encode('utf-8'))
#         try:
#         	news = getNews(url)
#         	saveAsSQL(news, id, 'educationnews')
#         	id = id +1
#         	j = j + 1
#         except Exception as e:
#         	pass
#         finally:
#         	pass
# end = time.clock()
# print "共爬取网易教育%s条新闻，耗时%f s" %(sum,end - start)


# id = 1
# start = time.clock()
# sum = 0
# #获取前40页新闻
# for i in range(1,10):
#     net = "http://3g.163.com/touch/article/list/BA8DOPCSwangning/%s-10.html" %i
# #   获取新闻列表
#     urls = getList(net)
# #   求和sum
#     sum = sum + len(urls)
# #   print "当前页解析出 %s 条" %len(urls)
#     j = 1
# #   对当前页面的每一条新闻获取URL
#     for url in urls:
#         print "正在读取第%s页第%s/%s条:%s" %(i,j,len(urls),url.encode('utf-8'))
#         try:
#         	news = getNews(url)
#         	saveAsSQL(news, id, 'carnews')
#         	id = id +1
#         	j = j + 1
#         except Exception as e:
#         	pass
#         finally:
#         	pass

# end = time.clock()
# print "共爬取网易汽车%s条新闻，耗时%f s" %(sum,end - start)


# id = 1
# start = time.clock()
# sum = 0
# #获取前40页新闻
# for i in range(1,10):
#     net = "http://3g.163.com/touch/article/list/BEO4GINLwangning/%s-10.html" %i
# #   获取新闻列表
#     urls = getList(net)
# #   求和sum
#     sum = sum + len(urls)
# #   print "当前页解析出 %s 条" %len(urls)
#     j = 1
# #   对当前页面的每一条新闻获取URL
#     for url in urls:
#         print "正在读取第%s页第%s/%s条:%s" %(i,j,len(urls),url.encode('utf-8'))
#         try:
#         	news = getNews(url)
#         	saveAsSQL(news, id, 'tournews')
#         	id = id +1
#         	j = j + 1
#         except Exception as e:
#         	pass
#         finally:
#         	pass
        
# #       保存到数据库里
        
        
# end = time.clock()
# print "共爬取网易旅游%s条新闻，耗时%f s" %(sum,end - start)


# id = 1
# start = time.clock()
# sum = 0
# #获取前40页新闻
# for i in range(1,10):
#     net = "http://3g.163.com/touch/article/list/BA8J7DG9wangning/%s-40.html" %i
# #   获取新闻列表
#     urls = getList(net)
# #   求和sum
#     sum = sum + len(urls)
# #   print "当前页解析出 %s 条" %len(urls)
#     j = 1
# #   对当前页面的每一条新闻获取URL
#     for url in urls:
#         print "正在读取第%s页第%s/%s条:%s" %(i,j,len(urls),url.encode('utf-8'))
#         try:
#         	news = getNews(url)
#         	saveAsSQL(news, id, 'AllNews')
#         	id = id +1
#         	j = j + 1
#         except Exception as e:
#         	pass
#         finally:
#         	pass
# end = time.clock()
# print "共爬取网易全类别%s条新闻，耗时%f s" %(sum,end - start)

print("爬爬爬爬爬\n")


