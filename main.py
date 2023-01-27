import requests
from bs4 import BeautifulSoup as bs
from urllib.parse import urljoin
from pprint import pprint
import json
import sys

s = requests.Session()
s.headers[
    "User-Agent"] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Safari/537.36"


def get_all_forms(url):
    soup = bs(s.get(url).content, "html.parser")
    return soup.find_all("form")


def get_form_details(form):
    details = {}

    try:
        action = form.attrs.get("action").lower()
    except:
        action = None
    method = form.attrs.get("method", "get").lower()
    inputs = []
    for input__Tag in form.find_all("input"):
        input_type = input__Tag.attrs.get("type", "text")
        input_name = input__Tag.attrs.get("name")
        input_value = input__Tag.attrs.get("value", "")
        inputs.append({"type": input_type, "name": input_name, "value": input_value})
    details["action"] = action
    details["method"] = method
    details["inputs"] = inputs
    return details


def is_vulnerable(response):
    errors = {
        "SYNTAX ERROR;",
        "warning: mysql",

        "unclosed quotation mark after character string,",

        "reported a quoted string that wasn't correctly ended.",
    }
    for error in errors:
        if error in response.content.decode().lower():
            return True
    return False


def scan_sql_injection(URL):
    f = open('sql_payload.txt', 'r')
    payloads = f.read().splitlines()

    for i in payloads:
        URL = f"{URL}{i}"
        res = s.get(URL)

        if is_vulnerable(res):
            print (json.dumps("[+] SQL Injection vuln detected url :", URL))
            return

    forms = get_all_forms(URL)
    print(json.dumps(f"[+] Detected {len(forms)} forms on {URL}."))

    for form in forms:
        form_details = get_form_details(form)
        for i in payloads:
            data = {}
            for input_tag in form_details["inputs"]:
                if input_tag["value"] or input_tag["type"] == "hidden":
                    try:
                        data[input_tag["name"]] = input_tag["value"] + i
                    except:
                        pass
                elif input_tag["type"] != "submit":
                    data[input_tag["name"]] = f"test{i}"

            URL = urljoin(URL, form_details["action"])
            if form_details["method"] == "post":
                res = s.post(URL, data=data)
            elif form_details["method"] == "get":
                res = s.get(URL, params=data)

            if is_vulnerable(res):
                print(json.dumps("[+] SQL Injection vulnerability detected, link:", URL))
                print(json.dumps("[+] Form:"))
                pprint(form_details)
                break


# XSS

def submit_form(form_details, url, value):
    target_url = urljoin(url, form_details["action"])
    inputs = form_details["inputs"]
    data = {}
    for input in inputs:
        if input["type"] == "text" or input["type"] == "search":
            input["value"] = value
        input_name = input.get("name")
        input_value = input.get("value")
        if input_name and input_value:
            data[input_name] = input_value

    print(json.dumps(f"[+] Submitting malicious payload to {target_url}"))
    print(json.dumps(f"[+] Data: {data}"))
    if form_details["method"] == "post":
        return requests.post(target_url, data=data)
    else:
        return requests.get(target_url, params=data)


def scan_xss(url):
    f = open('xss_payloads.txt', encoding="utf8")
    js_script = f.read().splitlines()

    forms = get_all_forms(url)
    print(json.dumps(f"[+] Detected {len(forms)} forms on {url}."))
    is_vulnerable = False
    for i in js_script:
        for form in forms:
            form_details = get_form_details(form)
            content = submit_form(form_details, url, i).content.decode()
            if i in content:
                print(json.dumps(f"[+] XSS Detected on {url}"))
                print(json.dumps(f"[*] Form details:"))
                print(json.dumps(form_details))
                is_vulnerable = True
        return is_vulnerable


if __name__ == "__main__":
    print("  Plase enter the url:  ")
    url = input()
    print("\n")
    print("SQL INJ scanning ")
    scan_sql_injection(url)
    print("XSS INJECTION ")
    scan_xss(url)
