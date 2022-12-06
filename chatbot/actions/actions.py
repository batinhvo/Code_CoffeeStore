# This files contains your custom actions which can be used to run
# custom Python code.
#
# See this guide on how to implement these action:
# https://rasa.com/docs/rasa/custom-actions


# This is a simple example for a custom action which utters "Hello World!"

from typing import Any, Text, Dict, List
from PIL import Image
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
        product_sp = "SELECT product_id, product_price FROM tbl_product WHERE product_name LIKE '%{}%'".format(pro_name)
        cf_db.execute(codeOfcoffee)
        result = cf_db.fetchall()
        print(codeOfcoffee)

        cf_db.execute(product_sp)
        result1 = str(cf_db.fetchall())
        result_vtri = result1.find(",")
        result_id = result1[0:result_vtri]
        result_price = result1[result_vtri:]
        result_so = result_id.replace('(' , ' ').replace( ')' , ' ').replace(',' , ' ')
        result_gia = result_price.replace('(' , ' ').replace( ')' , ' ').replace(',' , ' ')
        so = result_so.replace("'", '').replace("[", '')
        result2 = ((result_gia.replace("'", '').replace("]", '')+"vnđ").replace(" ", ''))
        print(result)
        s=int(so)
        if (result == []):
            dispatcher.utter_message("Hiện tại cửa không kinh doanh sản phẩm này. Bạn có thể tìm thấy sản phẩm tương tự từ mục sản phẩm của cửa hàng \n[Tại đây](http://localhost/Code_CoffeeStore/all-product-page)") 
        else:
            dispatcher.utter_message("Hiện tại cửa hàng đang kinh doanh sản phẩm này.")
            dispatcher.utter_message("Giá sản phẩm là: "+result2)
            dispatcher.utter_message("Bạn có thể xem thông tin chi tiết sản phẩm.[Tại đây](http://localhost/Code_CoffeeStore/chi-tiet-san-pham/"+ str(s) +")")
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
        codeOfcoffee = "SELECT product_name, product_price FROM tbl_product WHERE product_name LIKE '%{}%'".format(pro_name)
        cf_db.execute(codeOfcoffee)
        result = str(cf_db.fetchall())
        result_vtri = result.find(",")
        result_name = result[0:result_vtri]
        result_price = result[result_vtri:]
        result_ten = result_name.replace('(' , ' ').replace( ')' , ' ').replace(',' , ' ')
        result_gia = result_price.replace('(' , ' ').replace( ')' , ' ').replace(',' , ' ')
        result1 = result_ten.replace("'", '').replace("[", '')
        result2 = ((result_gia.replace("'", '').replace("]", '')+"vnđ").replace(" ", ''))
        print(result)
        print(result_name)
        if (result == []):
            dispatcher.utter_message("Hiện tại cửa hàng không kinh doanh sản phẩm này!") 
        else:
            dispatcher.utter_message("Giá sản phẩm "+result1+" là "+result2)
        myconn.rollback()
        myconn.close()
        return []