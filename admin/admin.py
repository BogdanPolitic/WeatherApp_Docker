from flask import Flask
from flask_restful import Resource, Api
from flask import request, Response, jsonify
import mysql.connector
import json
import datetime
import MySQLdb

app = Flask(__name__)
api = Api(app)

class Add_user(Resource):
    def get(self, user, password):
        #print("Adding new user")
        connection = mysql.connector.connect(user='root', password='root', host='db', database='teatru')
        sql_select_Query = ("insert into utilizatori (nume, parola, nr_bilete) values (%s, %s, %s)")
        cursor = connection.cursor()
        ret = ""
        try:
            cursor.execute(sql_select_Query, (user, password, 0))
            connection.commit()
            ret = "Utilizator adaugat cu succes"
        except mysql.connector.errors.IntegrityError:
            ret = "Utilizatorul nu a fost adaugat (user deja existent)"
        finally:
            cursor.close()
            connection.close()
        return ret


api.add_resource(Add_user, '/add_user/<string:user>/<string:password>')


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=80, debug=True)
