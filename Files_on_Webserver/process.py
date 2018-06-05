
import subprocess, shlex
import sys


cmd = 'hdfs dfs -rm -r /wordcount/output/'
args = shlex.split(cmd)
out, err = subprocess.Popen(args, stdout=subprocess.PIPE, stderr=subprocess.PIPE).communicate()


cmd = 'hadoop jar /usr/local/hadoop/hadoop-streaming-2.9.0.jar -file /home/hduser/Desktop/test/mapper.py -mapper mapper.py -file /home/hduser/Desktop/test/reducer.py -reducer reducer.py -output /wordcount/output -input /user/hduser/input/input.txt -file /home/hduser/Desktop/test/trainer.yml -file /var/www/facerec.com/images/testimage.jpg -file /home/hduser/Desktop/test/haarcascade_frontalface_alt.xml'


args = shlex.split(cmd)
out, err = subprocess.Popen(args, stdout=subprocess.PIPE, stderr=subprocess.PIPE).communicate()


cmd = 'hdfs dfs -cat /wordcount/output/*'
args = shlex.split(cmd)
out, err = subprocess.Popen(args, stdout=subprocess.PIPE, stderr=subprocess.PIPE).communicate()


print(out.split('\t')[0])


