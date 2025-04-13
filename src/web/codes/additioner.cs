using System;

class Program
{
    static void Main()
    {
        Console.Write("Adj meg egy számot: ");
        int szam1 = int.Parse(Console.ReadLine());

        Console.Write("Adj meg egy másik számot: ");
        int szam2 = int.Parse(Console.ReadLine());

        int osszeg = szam1 + szam2;
        Console.WriteLine($"Az összeg: {osszeg}");
    }
}
