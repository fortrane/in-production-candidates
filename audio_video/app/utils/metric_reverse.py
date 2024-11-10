import pickle
import pandas as pd

with open("annotation_training.pkl", "rb") as f:
    annotation_data = pickle.load(f, encoding='latin1')


print("\n\n\n")
df = pd.DataFrame()

for i, (key, value) in enumerate(annotation_data.items()):
    temp_df = pd.DataFrame(list(value.items()), columns=['filename', key])
    if df.empty:
        df = temp_df  # Если df пустой, инициализируем его
    else:
        df = pd.merge(df, temp_df, on='filename', how='outer')

print(df)
filename = '0axZSeaUbfs.002.mp4'

result = df.loc[df['filename'] == filename]

# Выводим результат
print(result)