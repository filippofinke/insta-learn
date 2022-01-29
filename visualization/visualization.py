# Filippo Finke
import pandas as pd
import matplotlib.pyplot as plt
import matplotlib.patches as mpatches
import numpy as np
users = pd.read_csv('../data/data.csv')

colors = {'follow_back':'g', 'not_follow_back':'r'}
fig, ax = plt.subplots()
ax.set_title('Users')
ax.set_xlabel('followers')
ax.set_ylabel('follows')

for i in range(len(users)):
    ax.scatter(users['followers'][i], users['follows'][i],color=colors[users['label'][i]])

green_patch = mpatches.Patch(color='green', label='follow_back')
red_patch = mpatches.Patch(color='red', label='not_follow_back')
ax.legend(handles=[green_patch, red_patch])
plt.savefig('users.png')
plt.show()