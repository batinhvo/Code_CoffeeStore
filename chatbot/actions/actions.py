# # This files contains your custom actions which can be used to run
# # custom Python code.
# #
# # See this guide on how to implement these action:
# # https://rasa.com/docs/rasa/custom-actions


# # This is a simple example for a custom action which utters "Hello World!"

# from types import DynamicClassAttribute
# from typing import Any, Text, Dict, List
# from rasa_sdk import Action, Tracker
# from rasa_sdk.executor import CollectingDispatcher
# import feedparser
# import mysql.connector
# import re
# import datetime
# from datetime import timedelta
# import json
# from rasa_sdk.events import SlotSet
# from connect import DataUpdate
# #
# #
# # class ActionHelloWorld(Action):
# #
# #     def name(self) -> Text:
# #         return "action_hello_world"
# #
# #     def run(self, dispatcher: CollectingDispatcher,
# #             tracker: Tracker,
# #             domain: Dict[Text, Any]) -> List[Dict[Text, Any]]:
# #
# #         dispatcher.utter_message(text="Hello World!")
# #
# #         return []


# class Hi(Action):
#     def name(self) -> Text:
#         return "Hi"
#     def run(self, dispatcher: CollectingDispatcher, tracker: Tracker, domain: Dict[Text, Any]) -> List[Dict[Text, Any]]:      
#         myconn = mysql.connector.connect(host = "localhost", user = "root", passwd = "", database="coffeestore")
#         mv_db = myconn.cursor()
#         product_name = tracker.get_slot("product_name")  
#         search = "SELECT product_name FROM tbl_product WHERE product_name LIKE '{}'".format(product_name)
#         mv_db.execute(search)
#         result = mv_db.fetchall()
#         # dispatcher.utter_message("Dưới đây là poster phim " + mv_name)
#         print(result)
#         if (result == []):
#             dispatcher.utter_message("K có") 
#         else:
#             dispatcher.utter_message("Có")
#         myconn.rollback()
#         myconn.close()
#         return []
