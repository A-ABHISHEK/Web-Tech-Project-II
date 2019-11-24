
import pandas as pd
from mlxtend.preprocessing import TransactionEncoder
from mlxtend.frequent_patterns import fpgrowth

f=open('a.txt','r')
s=f.read()
s=s.split(',\\n')
s=s[:len(s)-1]
dataset=[]
for i in s:
    j=i.split(',')
    dataset.append(j)
te = TransactionEncoder()
te_ary = te.fit(dataset).transform(dataset)
df = pd.DataFrame(te_ary, columns=te.columns_)
fpgrowth(df, min_support=0.5)
q=fpgrowth(df, min_support=0.5, use_colnames=True)

l=len(q['itemsets'])
s=[]

for i in range(l):
    s.append(list(q['itemsets'][i])[0])
s=set(s)
print(','.join(s))