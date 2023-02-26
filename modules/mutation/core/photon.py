import re
import concurrent.futures
from urllib.parse import urlparse

from core.dom import dom # find DOM vulnerabilitities
from core.log import setup_logger
from core.utils import getUrl, getParams
from core.requester import requester
from core.zetanize import zetanize
from plugins.retireJs import retireJs

logger = setup_logger(__name__)


def photon(seedUrl, headers, level, threadCount, delay, timeout):
    forms = []  # web forms
    processed = set()  # urls that have been crawled
    storage = set()  # urls that belong to the target i.e. in-scope
    schema = urlparse(seedUrl).scheme  # extract the scheme e.g. http or https
    host = urlparse(seedUrl).netloc  # extract the host e.g. example.com
    main_url = schema + '://' + host  # join scheme and host to make the root url
    storage.add(seedUrl)  # add the url to storage
    checkedDOMs = []

    def rec(target):
        url = getUrl(target, True)
        params = getParams(target, '', True)
        response = requester(url, params, headers, True, delay, timeout).text
        
        # Scan for JavaScript vulnerabilities ----------------------
        print(retireJs(url, response))
        # Scan for JavaScript vulnerabilities ----------------------
        
        # DOM vulnerability detection -----------
        #highlighted = dom(response)
        #clean_highlighted = ''.join([re.sub(r'^\d+\s+', '', line) for line in highlighted])
        #if highlighted and clean_highlighted not in checkedDOMs:
        #    checkedDOMs.append(clean_highlighted)
        #    #return(url) ####

        #    logger.good('Potentially vulnerable objects found at %s' % url)
        #    logger.red_line(level='good')
        #    for line in highlighted:
        #        logger.no_format(line, level='good')
        #    logger.red_line(level='good')
        # DOM vulnerability detection -----------

        forms.append(zetanize(response))
        matches = re.findall(r'<[aA].*href=["\']{0,1}(.*?)["\']', response)

        # DOM vulnerability output of CODE ----------------
        for link in matches:  # iterate over the matches
            # remove everything after a "#" to deal with in-page anchors
            link = link.split('#')[0]
            if link.endswith(('.pdf', '.png', '.jpg', '.jpeg', '.xls', '.xml', '.docx', '.doc')):
                pass
            else:
                if link[:4] == 'http':
                    if link.startswith(main_url):
                        storage.add(link)
                elif link[:2] == '//':
                    if link.split('/')[2].startswith(host):
                        storage.add(schema + link)
                elif link[:1] == '/':
                    storage.add(main_url + link)
                else:
                    storage.add(main_url + '/' + link)
        # DOM vulnerability output of CODE ----------------

    # run file (как я поняла) --------------------
    try:
        for x in range(level):
            urls = storage - processed  # urls to crawl = all urls - urls that have been crawled

            threadpool = concurrent.futures.ThreadPoolExecutor(
                max_workers=threadCount)
            futures = (threadpool.submit(rec, url) for url in urls)

            for i in concurrent.futures.as_completed(futures):
                pass
    except KeyboardInterrupt:
        return [forms, processed]



    return [forms, processed]
