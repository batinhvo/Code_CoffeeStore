# This files contains your custom actions which can be used to run
# custom Python code.
#
# See this guide on how to implement these action:
# https://rasa.com/docs/rasa/custom-actions


# This is a simple example for a custom action which utters "Hello World!"

from typing import Any, Text, Dict, List

from rasa_sdk import Action, Tracker
from rasa_sdk.executor import CollectingDispatcher
import random

import feedparser
import mysql.connector
import re
import json
from rasa_sdk.events import SlotSet

class Tl_sp_co_khong(Action):
    def name(self) -> Text:
        return "Tl_sp_co_khong"
    def run(self, dispatcher: CollectingDispatcher, tracker: Tracker, domain: Dict[Text, Any]) -> List[Dict[Text, Any]]:
        
        pro_name = tracker.get_slot("product_name")  
        print(pro_name)      
        # Lấy nội dung entity từ câu truy vấn
        myconn = mysql.connector.connect(host = "localhost", user = "root", passwd = "", database="coffeestore")
        cf_db = myconn.cursor()
        codeOfcoffee = "SELECT product_name FROM tbl_product WHERE product_name LIKE '%{}%'".format(pro_name)
        product_id = "SELECT product_id FROM tbl_product WHERE product_name LIKE '{}'".format(pro_name)
        cf_db.execute(codeOfcoffee)
        result = cf_db.fetchall()
        print(codeOfcoffee)
        cf_db.execute(product_id)
        result55 = str(cf_db.fetchall())
        result66 = result55.replace('(' , ' ').replace( ')' , ' ').replace(',' , ' ')
        result77 = result66.replace("'", ' ').replace('[' ,' ').replace( ']', ' ')
        link = "http://localhost/Code_CoffeeStore/chi-tiet-san-pham/"+result77
        print(link)
        if (result == []):
            dispatcher.utter_message("Hiện tại cửa KHÔNG CÓ sản phẩm này. Bạn có thể tìm thấy sản phẩm tương tự tại mục sản phẩm của cửa hàng \n[Tại đây](http://localhost/Code_CoffeeStore/all-product-page)") 
        else:
            dispatcher.utter_message("Hiện tại cửa hàng ĐANG CÓ sản phẩm này. Bạn có thể tìm thấy sản phẩm \n[Tại đây](http://localhost/Code_CoffeeStore/all-product-page)")
        myconn.close()
        return []

class Tl_sp_co_khong(Action):
    def name(self) -> Text:
        return "Tl_gia_sp"
    def run(self, dispatcher: CollectingDispatcher, tracker: Tracker, domain: Dict[Text, Any]) -> List[Dict[Text, Any]]:
        
        pro_name = tracker.get_slot("product_name")  
        print(pro_name)      
        # Lấy nội dung entity từ câu truy vấn
        myconn = mysql.connector.connect(host = "localhost", user = "root", passwd = "", database="coffeestore")
        cf_db = myconn.cursor()
        codeOfcoffee = "SELECT product_price FROM tbl_product WHERE product_name LIKE '%{}%'".format(pro_name)
        cf_db.execute(codeOfcoffee)
        result = str(cf_db.fetchall())
        results = result.replace('(' , ' ').replace( ')' , ' ').replace(',' , ' ')
        result1 = results.replace("'", ' ')
        print(codeOfcoffee)
        if (result == []):
            dispatcher.utter_message("Hiện tại cửa hàng không có sản phẩm này!") 
        else:
            dispatcher.utter_message("Giá sản phẩm này là " + result1 + "vnđ")
        myconn.rollback()
        myconn.close()
        return []