from urllib2 import Request, urlopen
from urllib import urlencode

url = 'http://localhost/rest/api/orders/'
request = Request(url)
response = urlopen(request).read()
print response

url = 'http://localhost/rest/api/orders/'
values = dict(name="MotoG2")
data = urlencode(values)
request = Request(url, data)
response = urlopen(request).read()
print response
