#!/usr/bin/env python
"""mapper.py"""

import sys

import cv2
import numpy as np


recognizer = cv2.face.LBPHFaceRecognizer_create()

recognizer.read('trainer.yml')
cascadePath = "haarcascade_frontalface_alt.xml"
faceCascade = cv2.CascadeClassifier(cascadePath);

img = cv2.imread('testimage.jpg')

gray=cv2.cvtColor(img,cv2.COLOR_BGR2GRAY)
faces=faceCascade.detectMultiScale(gray, 1.2,5)

for(x,y,w,h) in faces:
    cv2.rectangle(img,(x,y),(x+w,y+h),(225,0,0),2)
    Id, conf = recognizer.predict(gray[y:y+h,x:x+w])

print(str(Id))
