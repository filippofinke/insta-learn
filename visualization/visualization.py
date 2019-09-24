# Filippo Finke
import pandas as pd
import matplotlib.pyplot as plt
import numpy as np
users = pd.read_csv('../data/data.csv')

colors = {'follow_back':'r', 'not_follow_back':'g'}
fig, ax = plt.subplots()
ax.set_title('Users')
ax.set_xlabel('followers')
ax.set_ylabel('follows')
for i in range(len(users)):
    ax.scatter(users['followers'][i], users['follows'][i],color=colors[users['label'][i]])
plt.savefig('users.png')
plt.show()