szotar = {
    "macska": "cat",
    "kutya": "dog",
    "ház": "house"
}

szo = input("Adj meg egy magyar szót: ")

if szo in szotar:
    print(f"A(z) '{szo}' angolul: {szotar[szo]}")
else:
    print("Nincs benne a szótárban.")
