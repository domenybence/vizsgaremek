using System;

class Program
{
    static void Main()
    {
        Random rnd = new Random();
        int szam = rnd.Next(1, 101); // 1 és 100 között
        Console.WriteLine($"A véletlenszám: {szam}");
    }
}
