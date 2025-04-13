import random

gondolt_szam = random.randint(1, 10)
tipp = int(input("Találd ki a számot 1 és 10 között: "))

if tipp == gondolt_szam:
    print("Gratulálok, eltaláltad!")
else:
    print(f"Sajnálom, a szám {gondolt_szam} volt.")
