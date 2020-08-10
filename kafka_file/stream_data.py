from tweepy.streaming import StreamListener
from tweepy import OAuthHandler
from tweepy import Stream
from kafka import SimpleProducer, KafkaClient
import json

access_token = "2584490724-ZOEJc5320HRi0fp6VT8uwQfqiNu5Quj6g2oqJm8"
access_token_secret =  "mWY1yl3z0wnMa8mhyMvw2wYXODtqB6yvmKtmVOAf2bHlL"
consumer_key =  "9EDriEjU65xa7xibG7i0V1pvi"
consumer_secret =  "mz73lwClhfAL75OrlwUVzGvJtJaYy75xN8tzFH0c3rmRrKBLry"

class StdOutListener(StreamListener):
    def on_data(self, data):
        producer.send_messages("twitterstream", data.encode('utf-8','ignore'))
	data=json.loads(data)
        try:
	   print (data["text"])
	except:
	   print(data["text"])
        return True

kafka = KafkaClient("localhost:9092")
producer = SimpleProducer(kafka)
l = StdOutListener()
auth = OAuthHandler(consumer_key, consumer_secret)
auth.set_access_token(access_token, access_token_secret)
stream = Stream(auth, l)
stream.filter(track=['RailMinIndia','rail minister','Piyush Goyal','northern railways','bdcoe'], stall_warnings=True, languages = ['en'])
