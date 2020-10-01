from pyspark import SparkConf, SparkContext
from pyspark.mllib.classification import  NaiveBayesModel
from pyspark.streaming import StreamingContext
from pyspark.streaming.kafka import KafkaUtils
from pyspark.mllib.feature import HashingTF
from pyspark.mllib.feature import IDF
from pyspark.mllib.regression import LabeledPoint

import operator
import pickle
import json
import MySQLdb


def insert_tweet(tweet,username,pnr,prediction,tweet_id,latitude,longitude):
    HOST = ""
    PORT = 3306
    USER = ""
    PASSWORD = ""
    DB = ""

    query = 'INSERT INTO tweets(tweet,username,pnr,prediction,tweet_id,latitude,longitude,time) VALUES ("%s","%s",%s,%s,%s,%s,%s,CURRENT_TIMESTAMP);'% (tweet,username,str(pnr),str(int(prediction)),str(tweet_id),str(latitude),str(longitude))
    try:
        conn = MySQLdb.connect(host=HOST,port=PORT,user=USER,passwd=PASSWORD,db=DB)
        cursor = conn.cursor()
        cursor.execute(query)
        print("Database insertion SUCCESSFUL!!")
        conn.commit()
    except MySQLdb.Error as e:
        print(e)
        print("Database insertion unsuccessful!!")
    finally:
        conn.close()

from pyspark.streaming import StreamingContext
conf = SparkConf().setMaster("local[2]").setAppName("Streamer")
sc = SparkContext(conf=conf)
sc.setLogLevel("ERROR")
val = sc.parallelize("abd")


ssc = StreamingContext(sc, 10)
ssc.checkpoint("checkpoint")
kstream = KafkaUtils.createDirectStream(
ssc, topics = ['twitterstream'], kafkaParams = {"metadata.broker.list": 'localhost:9092'})
tweets = kstream.map(lambda x: json.loads(x[1]))

with open('IRModel1', 'rb') as f:
    loadedModel = pickle.load(f)

bc_model = sc.broadcast(loadedModel)


def process_data(data):

        print("Processing data ...")        

        if (not data.isEmpty()):
            nbModel=bc_model.value
            hashingTF = HashingTF(100000)
            tf = hashingTF.transform(data.map(lambda x: x[0].encode('utf-8','ignore')))
            tf.cache()
            idf = IDF(minDocFreq=2).fit(tf)
            tfidf = idf.transform(tf)
            tfidf.cache()
            prediction=nbModel.predict(tfidf)

            temp = []
            i=0
            for p,q,r in data.collect():
                temp.append([])
                temp[i].append(p.encode('utf-8','ignore'))
                temp[i].append(q)
                temp[i].append(r)
                i+=1
            i=0
            for p in prediction.collect():
                temp[i].append(p)
                i+=1		

            print(temp)
            for i in temp:
                insert_tweet(str(i[0]),str(i[1]),"0",int(i[3]),int(i[2]),"0","0")
        else:
            print("Empty RDD !!!")        
            pass

twitter=tweets.map(lambda tweet: tweet['user']['screen_name'])
tweet_text = tweets.map(lambda tweet: tweet['text'])

txt = tweets.map(lambda x: (x['text'], x['user']['screen_name'], x['id']))
txt.foreachRDD(process_data)

#text = tweet_text.map(lambda x: x.encode('utf-8','ignore'))
#text.foreachRDD(process_data)


ssc.start() 
ssc.awaitTerminationOrTimeout(1000)
ssc.stop(stopGraceFully = True)
