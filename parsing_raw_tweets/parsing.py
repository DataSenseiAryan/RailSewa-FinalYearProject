import json
import pandas as pd
from pandas import DataFrame

tweets_data_path = 'abc.txt'
tweets_data = []
tweets_file = open(tweets_data_path, "r")
for line in tweets_file:
	try:
		tweet = json.loads(line)
		tweets_data.append({"msg":tweet['text'],"user":tweet['user']['screen_name']})
	except:
		print("here")
		continue

print(tweets_data)
df=DataFrame(tweets_data)
print(df)

df.to_csv('out.csv', sep='\t')


