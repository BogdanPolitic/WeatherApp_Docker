FROM python:3-onbuild
COPY . /usr/src/app

RUN pip3 install mysql-connector-python

COPY requirements.txt .
RUN pip install -r requirements.txt

CMD ["python3", "api.py"]