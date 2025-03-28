using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;

namespace DronberletGUI
{
    class BerlesViewModel : INotifyPropertyChanged
    {
        public event PropertyChangedEventHandler? PropertyChanged;

        public BerlesModel _aktberles = new BerlesModel();

        public BerlesModel AktBerles 
        {
            get
            {
                return _aktberles;
            }
            set
            {
                _aktberles = value;
                PropertyChanged?.Invoke(this, new PropertyChangedEventArgs("Aktberles"));
            }
        }

        public List<BerlesModel> Berlesek = new List<BerlesModel>();
        public List<BerlesModel> BerlesekD = new List<BerlesModel>();


        public BerlesViewModel()
        {
            foreach (var item in File.ReadAllLines("dronberletek2024.csv").Skip(1))
            {
                Berlesek.Add(new BerlesModel(item));
               
            }
            BerlesekD = Berlesek.DistinctBy(x => x.Dronsn).ToList();
           
        }
            

       
    }
}
