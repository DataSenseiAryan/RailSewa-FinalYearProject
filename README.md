# Real Time Indian Railways Twitter Complaint Administration System

The project invloves real-time classfication of Indian Railways tweets into emergency and feedback using Apache Spark, Kafka, MySQL and PHP. It also facilitates interactive response via Twitter API in the same application with the help of front-end technologies like HTML, CSS, Bootstrap, JQuery, JavaScript and AJAX. The complete cluster is deployed on AWS EC2 and it uses AWS RDS for database operations.


###### [Youtube Video](https://youtu.be/dyg58M6-6MU)

###### [Presentation](https://github.com/aryanc55/RailSewa-FinalYearProject/raw/master/assets/presentation.pdf)

###### [Thesis](https://github.com/aryanc55/RailSewa-FinalYearProject/blob/master/assets/thesis.pdf)


### Project Snapshots:

1.![](https://github.com/aryanc55/RailSewa-FinalYearProject/blob/master/assets/login.jpeg?raw=true)
2.![](https://github.com/aryanc55/RailSewa-FinalYearProject/blob/master/assets/emergency.jpeg?raw=true) 
3.![](https://github.com/aryanc55/RailSewa-FinalYearProject/blob/master/assets/feedback.jpeg?raw=true) 
4.![](https://github.com/aryanc55/RailSewa-FinalYearProject/blob/master/assets/reply.jpeg?raw=true) 
5.![](https://github.com/aryanc55/RailSewa-FinalYearProject/blob/master/assets/reply_sent.jpeg?raw=true)


## Pre-Requisites:

#### All installation and setup is given in thesis!.
(Due to different versions of libraries, frameworks,tools used things may thorw error)

Still you may reference these links.

* Setup AWS account and launch required numbers of EC2 instances. (master,slave,website server)[(Launch instance)](https://www.novixys.com/blog/setup-apache-hadoop-cluster-aws-ec2/)

* Setup AWS RDS for database.[(Documentation)](https://docs.aws.amazon.com/AmazonRDS/latest/UserGuide/CHAP_GettingStarted.html)

* From twitter api get Access token , consumer token etc. [(How-to)](https://gist.github.com/aryanc55/21122bcce026e7fe4383e6d13c66b992)

* Prepare EC2 servers for ditributed computing i.e. establish communication in between system. Setup [(SSH Setup)](https://www.novixys.com/blog/setup-apache-hadoop-cluster-aws-ec2/)

* Setup Spark Cluster of atleast 3 Nodes [(Spark Installation)]( https://blog.insightdatascience.com/simply-install-spark-cluster-mode-341843a52b88)

* Install Kakfa & Zookeeper [(Kakfa Installation)](https://codeforgeek.com/how-to-setup-multi-node-multi-broker-kafka-cluster-in-aws/) [(Zookeeper Installation)](https://github.com/airavata-courses/TeamSangam/wiki/Zookeeper-Installation-on-EC2)

* Install Xampp server on ec2 instance dedicated to xampp only.[(Xampp Setup)](https://www.9lessons.info/2015/12/amazon-ec2-setup-with-ubuntu-and-xampp.html)

* Python 3

## How to execute project:

*Some abbreaviations:
##### m- ec2master
##### s1- ec2slave1
##### s2- ec2slvae2
##### x - ec2xampp

###### on m (on master):

**STEP-1:** Login into remote database Amazon RDS.


>mysql -h "your database ip" -P 3306 -u "username" -p


**STEP-2:** Create a database:

>create twitter;

>use twitter;


**STEP-3:** Create tweet table :


>CREATE TABLE tweets (id int AUTO_INCREMENT PRIMARY KEY, tweet varchar(280), username varchar(50), pnr bigint(10), prediction int(1), tweet_id bigint(10),latitude decimal(10,8) ,longitude decimal(11,8) ,time TIMESTAMP , response_status int(1), response varchar(280));


**STEP-4:** Similarly create *admin* database table:


###### on m,s1 and s2:

**STEP-5:** Start  Apache Zookeeper:

>zkServer.sh start

if path for zookeper is not setup in bash then cd (change directory to zookeeper folder).

###### on m:

**STEP-6:** Start Apache Kafka:

*nohup* is used for teminal to not hang up! important when aceeesing remote system using local terminal

cd kafka folder (cd means change directory to kafka folder)

>nohup bin/kafka-server-start.sh config/server.properties &

###### on s1 and s2:

cd kakfa folder

>nohup bin/kafka-server-start.sh config/server.properties &

###### on m:


**STEP-7:** Create topic for kafka (do it only only once)

cd kafka folder:


>bin/kafka-topics.sh --create --zookeeper --partitions 1 --topic twitterstream localhost:2181 --replication-factor 1


###### on m ,s1,s2 in same order:

**STEP-8:** Start kafka Consumer

Again *cd* to where kafka is installed


>bin/kafka-console-consumer.sh --bootstrap-server localhost:2181 --topic twitterstream --from-beginning &


###### on m:

**STEP-9:** Execute streamimg code

change directory into Railsewa..... folder


>python kafka_file/stream_data.py &



**STEP-10:** Job submission on spark for training (do it only once)


>spark-submit train_model.py


**STEP-11:** Job submission on spark for prediction


>spark-submit --packages org.apache.spark:spark-streaming-kafka-0-8_2.11:2.1.0 new_live_processing.py


###### on x:

**STEP-12:** Start xampp server to launch website

>sudo /opt/lampp/lampp start

**Final Step:** Access website anywhere


>To view phpmyadmin http://IP-Address/phpmyadmin/


>To access website http://IP-Address/path

Finally open railways/index.php file to interact with UI and manage tweets in real-time.




## License:
MIT License
Copyright (c) 2020 Aryan Chaudhary
[MIT](LICENSE)



**ToDo**
You may work on these!
- Develop functioning tweet analysis part.
- Develop API and integrate the app.
- Implement ML module as a pipline(to actually remove a very subtle but dangerous bug).
- May be create a Docker to deploy whole project with just a single click!

**Minatainence**
Currently all of us are busy in our personal work/projects and hence we are not maintaining this project anymore. Still PRs and Issues are welcomed but we do not assure that we will look into it.

**Thank you for your time**

**Show some :heart: by leaving a :star: at this page!**  </br>
