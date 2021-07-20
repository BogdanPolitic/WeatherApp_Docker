from flask import Flask
from flask_restful import Resource, Api
from flask import request, Response, jsonify
import mysql.connector
import json
import datetime

app = Flask(__name__)
api = Api(app)

class Login_User(Resource):
    def get(self, username, password):
        connection = mysql.connector.connect(user='root', password='root', host='db', database='weather_database')
        sql_select_Query = ("select * from users where username=%s and password=%s")
        cursor = connection.cursor()
        cursor.execute(sql_select_Query, (username,password))
        records = cursor.fetchall()

        if len(records) == 0:
            cursor.close()
            connection.close()
            return -1

        for user in records:
            return user[2]

class Register_User(Resource):
    def get(self, username, password):
        connection = mysql.connector.connect(user='root', password='root', host='db', database='weather_database')
        sql_select_Query = ("select * from users where username=%s")
        cursor = connection.cursor()
        cursor.execute(sql_select_Query, (username,))
        records = cursor.fetchall()

        if len(records) > 0:
            cursor.close()
            connection.close()
            return 1

        sql_insert_Query = ("insert into users values (%s, %s, %s)")
        cursor.execute(sql_insert_Query, (username, password, 1))
        connection.commit()

        cursor.close()
        connection.close()
        return 0

class Update_User_Location(Resource):
    def get(self, username, location_name):
        connection = mysql.connector.connect(user='root', password='root', host='db', database='weather_database')
        cursor = connection.cursor()

        sql_select_Query = ("select location_id from locations where location_name=%s")
        cursor.execute(sql_select_Query, (location_name,))
        records = cursor.fetchall()

        if len(records) == 0:
            cursor.close()
            connection.close()
            return -1

        for location in records:
            location_id = location[0]

        sql_update_Query = ("update users set my_location=%s where username=%s")
        cursor.execute(sql_update_Query, (location_id, username))
        connection.commit()
        
        cursor.close()
        connection.close()
        return location_id

class Get_weather_condition(Resource):
    def get(self, condition_id):
        connection = mysql.connector.connect(user='root', password='root', host='db', database='weather_database')
        cursor = connection.cursor()
        sql_select_Query = ("select * from weather_conditions where condition_id=%s")
        cursor.execute(sql_select_Query, (condition_id,))
        records = cursor.fetchall()

        ret = []

        for row in records:
            new_row = ()
            for var in row:
                new_var = var.__str__()
                new_row = new_row + (new_var,)

            ret.append(new_row)

        cursor.close()
        connection.close()

        return ret
        

class Show_weather_history(Resource):
    def get(self, location_id, month, year):
        connection = mysql.connector.connect(user='root', password='root', host='db', database='weather_database')
        sql_select_Query = ("select * from weather_data where location_id=%s and month=%s and year=%s order by year, month, day")
        cursor = connection.cursor()
        cursor.execute(sql_select_Query, (location_id, month, year))
        records = cursor.fetchall()
        ret = []
        for row in records:
            new_row = ()
            for var in row:
                new_var = var.__str__()
                new_row = new_row + (new_var,)
            ret.append(new_row)

        cursor.close()
        connection.close()

        return ret

class Show_weather_prediction(Resource):
    def get(self, location_id, start_day, start_month, end_day, end_month, year):
        connection = mysql.connector.connect(user='root', password='root', host='db', database='weather_database')
        sql_select_Query = ("select * from weather_data where location_id=%s and year=%s and ((month=%s and day>=%s) or (month=%s and day<=%s)) order by year, month, day")
        cursor = connection.cursor()
        cursor.execute(sql_select_Query, (location_id, start_month, start_day, end_month, end_day, year))
        records = cursor.fetchall()
        ret = []
        for row in records:
            new_row = ()
            for var in row:
                new_var = var.__str__()
                new_row = new_row + (new_var,)
            ret.append(new_row)

        cursor.close()
        connection.close()

        return ret

api.add_resource(Login_User, '/login_user/<string:username>/<string:password>')
api.add_resource(Register_User, '/register_user/<string:username>/<string:password>')
api.add_resource(Update_User_Location, '/update_user_location/<string:username>/<string:location_name>')
api.add_resource(Get_weather_condition, '/get_weather_condition/<int:condition_id>')
api.add_resource(Show_weather_history, '/show_weather_history/<int:location_id>/<int:month>/<int:year>')
api.add_resource(Show_weather_prediction, '/show_weather_prediction/<int:location_id>/<int:start_day>/<int:start_month>/<int:end_day>/<int:end_month>/<int:year>')


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=80, debug=True)
