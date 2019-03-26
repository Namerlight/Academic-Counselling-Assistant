import sys
import json
from vaderSentiment.vaderSentiment import SentimentIntensityAnalyzer

x=sys.argv[1]
data=json.loads(x)

analyser = SentimentIntensityAnalyzer()

for item in data:
    item['sentiment'] = analyser.polarity_scores(item['text'])
    item.pop('text', None)

print(json.dumps(data))
