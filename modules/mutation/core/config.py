changes = '''Negligible DOM XSS false positives;x10 faster crawling'''
globalVariables = {}  # it holds variables during runtime for collaboration across modules

defaultEditor = 'nano'
blindPayload = ''  # your blind XSS payload
xsschecker = 'v3dm0s'  # A non malicious string to check for reflections and stuff

minEfficiency = 90  # payloads below this efficiency will not be displayed

delay = 0  # default delay between http requests
threadCount = 10  # default number of threads
timeout = 10  # default number of http request timeout

# attributes that have special properties
#specialAttributes = ['srcdoc', 'src']

#badTags = ('iframe', 'title', 'textarea', 'noembed',
#           'style', 'template', 'noscript')

tags = ('html', 'd3v', 'a', 'details')  # HTML Tags

functions = (  # JavaScript functions to get a popup
    '[8].find(confirm)', 'confirm()',
    '(confirm)()', 'co\u006efir\u006d()',
    '(prompt)``', 'a=prompt,a()')

headers = {  # default headers
    'User-Agent': '$',
    'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
    'Accept-Language': 'en-US,en;q=0.5',
    'Accept-Encoding': 'gzip,deflate',
    'Connection': 'close',
    'DNT': '1',
    'Upgrade-Insecure-Requests': '1',
}