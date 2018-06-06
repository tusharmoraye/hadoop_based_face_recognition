# Hadoop Based Face Recognition

In this project, we use Apache Hadoop for distributed storage and processing as we need to scan through the huge number of images for face recognition task.
We have implemented this idea in an Application. We have developed an Android app that captures the image of a person and sends it to the server. Our server processes the image on Hadoop and returns the id of the person. That id is then queried in MySQL server to retrieve the information about the person. The information is then sent back to the Android app.
Our application can be used for criminal recognition.

## Getting Started

We need to setup a Hadoop cluster to store our files on HDFS and also to use Map-Reduce framework. We also need to install OpenCV in python. This project was successfully implemented on Ubuntu 16.04LTS.

### Prerequisites

```
Ubuntu
Hadoop
Python 
LAMP 
OpenCV
Android Studio
```

## Executing The Project

### Hadoop cluster

There are many tutorials on the internet for setting up the Hadoop cluster.

### Train LBPH Algorithm 

Use train.py file for training. Your training images of each user should be stored in `dataSet/` directory. Refer [this](https://thecodacus.com/face-recognition-opencv-train-recognizer/#.WxfQMRy-kYc) blog for better understanding.
You will have `trainer.yml` file inside `trainer/` directory. Your model is trained and stored in `trainer.yml` file. You can use this `trainer.yml` file to recognize know faces. This step will take a long time depending on the size of your training data.

### LAMP setup

Install LAMP or any other alternatives on your system. Place all files from `Files_on_Webserver` folder to your folder in webserver's directory (i.e. /var/www/html/ in case of Ubuntu).
Create a database to store user data.

### process.py file

Open the file and update the file paths to your respective file paths.

### Android App

You can get Android app used for this project from [this repository.](https://github.com/tusharmoraye/Android_app_for_Hadoop_Based_Face_Recognition_Project) 
Clone the repository and open it in Android Studio. Change the IP address with your system IP address. Run the app on your phone and give the necessary permissions.


## Acknowledgments

* refer this tutorial for face recognition: https://thecodacus.com/face-recognition-opencv-train-recognizer/#.WxfQMRy-kYc

