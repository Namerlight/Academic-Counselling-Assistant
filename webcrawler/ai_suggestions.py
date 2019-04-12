import numpy as np
import matplotlib.pyplot as plt


def estimate_coef(x, y):
    # number of observations/points
    n = np.size(x)

    # mean of x and y vector
    m_x, m_y = np.mean(x), np.mean(y)

    # calculating cross-deviation and deviation about x
    SS_xy = np.sum(y * x) - n * m_y * m_x
    SS_xx = np.sum(x * x) - n * m_x * m_x

    # calculating regression coefficients
    b_1 = SS_xy / SS_xx
    b_0 = m_y - b_1 * m_x

    return b_0, b_1


def plot_regression_line(x, y, b):
    # plotting the actual points as scatter plot
    plt.scatter(x, y, color="m", marker="o", s=30)

    # predicted response vector
    y_pred = b[0] + b[1] * x

    # plotting the regression line
    plt.plot(x, y_pred, color="g")

    # putting labels
    plt.xlabel('X')
    plt.ylabel('Y')

    # function to show plot
    plt.show()


# observations
x_list = [0, 4, 6, 2, 7, 4, 5, 44, 22, 64, 34, 23, 35, 32, 57, 52, 33, 70, 63, 56, 43, 56, 78, 51, 52, 44, 66]
x = np.asarray(x_list)
y_list = [1, 3, 2, 5, 7, 8, 8, 19, 10, 12, 33, 55, 34, 34, 59, 49, 46, 70, 81, 34, 23, 62, 50, 45, 53, 33, 51]
y = np.array(y_list)

# estimating coefficients
b = estimate_coef(x, y)
print("Estimated coefficients:\nb_0 = {}  \
\nb_1 = {}".format(b[0], b[1]))

# plotting regression line
plot_regression_line(x, y, b)

print(b[0], b[1])

inp = 40
op = int(inp*b[1] + b[0])
op_up = int(op+op*0.3)
op_lw = int(op-op*0.3)
print(op_up, op_lw)

print("When x is {}, y is {}".format(inp, int(op)))

for i in range(op_lw, op_up):
    try:
        print(y_list[y_list.index(i)])
    except ValueError:
        print('', end='')





