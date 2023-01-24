import requests
from bs4 import BeautifulSoup
import sys
from urllib.parse import urljoin
import json

s = requests.Session()
s.headers["User-Agent"] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36"

def get_forms(url):
    sou = BeautifulSoup(s.get(url).content, "html.parser")
    return sou.find_all("form")

def form_details(form):
    details_Of_Form = {}
    action = form.attrs.get("action")
    method = form.attrs.get("method", "get")
    inputs = []

    for input_tag in form.find_all("input"):
        input_type = input_tag.attrs.get("type", "text")
        input_name = input_tag.attrs.get("name")
        input_value = input_tag.attrs.get("value", "")
        inputs.append({
            "type": input_type, 
            "name" : input_name,
            "value" : input_value,
        })
        
    details_Of_Form['action'] = action
    details_Of_Form['method'] = method
    details_Of_Form['inputs'] = inputs
    return details_Of_Form


def vulnerable(response):

    errors = {"Quoted string not properly finished,", 
              "Unclosed quotation mark after the character string,",
              "SQL syntax error" 
             }
    json_data = json.dumps(errors)
    for error in errors:
        if error in response.content.decode().lower():
            return json_data
            return True
    return False


def sql_injection_scan(url):
    forms = get_forms(url)
    print(f"[+] Detects {len(forms)} forms on {url}.")
    for form in forms:
        details = form_details(form)  
        for i in "\"'":
            data = {}
            for input_tag in details["inputs"]:
                if input_tag["type"] == "hidden" or input_tag["value"]:
                    data[input_tag['name']] = input_tag["value"] + i
                elif input_tag["type"] != "submit":
                    data[input_tag['name']] = f"test{i}"
    
            print(url)
            form_details(form)

            if details["method"] == "post":
                res = s.post(url, data=data)
            elif details["method"] == "get":
                res = s.get(url, params=data)
            if vulnerable(res):
                print("Link has vulnerability to SQL injection attack: ", url )
            else:
                print("No SQL injection vulnerability was discovered.")
                break



if __name__ == "__main__":
    urlToBeChecked = input("Enter URL: ")
    sql_injection_scan(urlToBeChecked)