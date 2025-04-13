using System;

class Program
{
    static void Main()
    {
        DateTime most = DateTime.Now;
        Console.WriteLine("Aktuális dátum és idő: " + most.ToString("yyyy.MM.dd HH:mm:ss"));
    }
}
