import matplotlib.pyplot as plt
import numpy as np

beton = np.array([20, 30, 40, 50, 60])
khaoa = np.array([5, 10, 15, 20, 25])

plt.xlabel('Proti mash e income')
plt.ylabel('Khete jaoar har')


plt.title("Ae vs Bae")
plt.plot(beton, khaoa)
plt.show()
