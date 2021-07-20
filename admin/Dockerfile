FROM python:3-onbuild
COPY . /usr/src/app

COPY requirements.txt .
RUN pip install -r requirements.txt

RUN pip3 install mysql-connector-python

RUN pip install mysqlclient

CMD ["python", "admin.py"]