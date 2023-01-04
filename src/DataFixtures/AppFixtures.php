<?php

namespace App\DataFixtures;

use       Doctrine\Bundle\FixturesBundle\Fixture;
use       Doctrine\Persistence\ObjectManager;

use       App\Entity\User;
use       App\Entity\Project;

use       App\Entity\Individual;
use       App\Entity\Family;
use       App\Entity\NameStructure;

use       App\Entity\MediaRecord;
use       App\Entity\FileReference;
use       App\Entity\MediaElement;

use       App\Entity\SubmitterRecord;
use       App\Entity\RepositoryRecord;
use       App\Entity\SourceRecord;

class AppFixtures extends Fixture {
    const USERNAME = array( 'demo', 'michael', 'filicis' );
    const PASSWORD = '$2y$13$CA8Wk8FsSKcFiNomYQGR/O71G0LuFGQQxnq6VMquo1YhNltKSJAKO';
    const ROLES = array( 'ROLE_ADMIN' );

    const PROJECT = array( 'demo', 'project01', 'project02' );

    const INDIVIDUAL = array( '', '', '', '' );
    const FAMILY = array( '', '', '', '' );
    const NAME = array( '', '', '', '' );
    const SUBMITTER = array( '', '', '', '' );
    const REPOSITORY = array( 'Mit hemmelige sted', 'Erik Brejls hjemmeside', 'Rigsarkivet', 'Danske Slægtsforskere' );

    const MEDIAF = array(
        array( 'Title 1', '', '' ),
        array( 'Title 2', '', '' ),
        array( 'Title 3', '', '' ),
        array( 'Title 4', '', '' ),
    );

    const MEDIA = array(
        array(
            'X3225190',
            'Images/Lokaliteter/Bormholm/Sønder herred/Aaker/data_kirkeboeger1892_112_3_022_0090a-FK.Jpg',
            'Jpg',
            'KB-1960-D-Aarkirkeby: Anne Møller (1960 - )',
        ),
        array(
            'X3225191',
            'Images/Lokaliteter/Bormholm/Vester herred/Knudsker sogn/data_kirkeboeger1892_093_3_025_0064a-FK.Jpg',
            'Jpg',
            'KB-1960-D-Knudsker sogn: Anne Møller (1960 - )',
        ),
        array(
            'X3225192',
            'Images/Personer/Knud Valdemar Møller (1914-1969).jpg',
            'jpg',
            'Knud Valdemar Møller (1914 - 1969)',
        ),
        array(
            'X3225193',
            'Images/Personer/Knud Valdemar Møller.jpg',
            'jpg',
            'Knud Valdemar Møller (1914-1969)',
        ),
        array(
            'X3225194',
            'Images/Lokaliteter/Bormholm/Sønder herred/Aaker/data_kirkeboeger1892_111_3_007_0073a-FM.Jpg',
            'Jpg',
            'KB-1914-D-Aaker sogn: Knud Valdemar Møller',
        ),
        array(
            'X3225195',
            'Images/Lokaliteter/Bormholm/Vester herred/Rønne/data_kirkeboeger1892_099_3_030_0250a-FK.Jpg',
            'Jpg',
            'KB-1915-D-Rønne: Norma Anine Møller',
        ),
        array(
            'X3225196',
            'Images/Lokaliteter/København/Sokkelund Herred/Søborggaard sogn/data_kirkeboeger1892_159_3_009_0144a-FK.Jpg',
            'Jpg',
            'KB-1937-D: Søborggaard sogn: Grethe Marie Jensen',
        ),
        array(
            'X3225197',
            'Images/Personer/Gunhild Nielsine Valborg Uttrup Christensen.jpg',
            'jpg',
            'Gunhild Jensen',
        ),
        array(
            'X3225198',
            'Images/Personer/Mormor/A0001 0018.jpg',
            'jpg',
            'Martha, Gunhild og Karla',
        ),
        array(
            'X3225199',
            'Images/Personer/Piger på MC.jpg',
            'jpg',
            '2 piger på MC, den ene er Gunhild',
        ),
        array(
            'X3225200',
            'Images/Lokaliteter/Aalborg/Hindsted herred/Storarden/data_kirkeboeger1892_C179_H_010_0099a-FK.Jpg',
            'Jpg',
            'KB-1909-D: Storarden sogn; Gundhild Nielsine Valborg Uttrup Christensen',
        ),
        array(
            'X3225201',
            'Images/Lokaliteter/Aalborg/Hindsted herred/Storarden/data_kirkeboeger1892_C179_H_010_0099a-FK.Jpg',
            'Jpg',
            'KB-1909-D: Storarden; Gunhild Nielsine Valborg Uttrup Pedersen',
        ),
        array(
            'X3225202',
            'Images/Personer/Peter Severin Jensen.jpg',
            'jpg',
            'Peter Severin Jensen (1905-1981)',
        ),
        array(
            'X3225203',
            'Images/Personer/Box14Foto015-0.jpg',
            'jpg',
            'Peter Jensen med bil (Plymouth årgang -38)',
        ),
        array(
            'X3225204',
            'Images/Billeder/A0017-001.jpg',
            'jpg',
            'Teknologisk Instituts Kursus i Autogensvejsning - Peter Jensen forrest række, nr 4 fra højre',
        ),
        array(
            'X3225205',
            'Images/Documenter/Peter Severin Jensen/Dødsattest - Peter Severin Jensen.pdf',
            'pdf',
            'Dødsattest - Peter Severin Jensen',
        ),
        array(
            'X3225206',
            'Images/Lokaliteter/Aalborg/Hindsted herred/Storarden/data_kirkeboeger1892_C179_H_010_0007a-FM.Jpg',
            'Jpg',
            'KB-1905-D: Storarden; Peter Severin Jensen',
        ),
        array(
            'X3225207',
            'Images/Documenter/Peter Severin Jensen/Dåbsattest - Peter Severin Jensen.pdf',
            'pdf',
            'Dåbsattest: Peter Severin Jensen',
        ),
        array(
            'X3225208',
            'Images/Personer/Box20Foto017.jpg',
            'jpg',
            'Ludvig Rasmussen',
        ),
        array(
            'X3225209',
            'Images/Personer/Soldat.jpg',
            'jpg',
            'Ludvig Rasmussen',
        ),
        array(
            'X3225210',
            'Images/Personer/Ludvig Rasmussen.jpg',
            'jpg',
            'Ludvig Rasmussen',
        ),
        array(
            'X3225211',
            'Images/Personer/Ludvig Rasmussen yngre udgave.jpg',
            'jpg',
            'Ludvig Rasmussen',
        ),
        array(
            'X3225212',
            'Images/Personer/Box06Foto038.jpg',
            'jpg',
            'Margrethe og Ludvig Rasmussen',
        ),
        array(
            'X3225213',
            'Images/Personer/A0006 0071.jpg',
            'jpg',
            'Ludvig Rasmussen med avis og barnebarn',
        ),
        array(
            'X3225214',
            'Images/Documenter/Ludvig Rasmussen/2014-10-23 17.13.24.jpg',
            'jpg',
            'Bekendtgørelse - Holbæk Amts Venstreblad',
        ),
        array(
            'X3225215',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/data_kirkeboeger1892_372_3_008_0004a-FM.Jpg',
            'Jpg',
            'KB-1893-D: Nørre Asmindrup sogn: Ludvig Rasmussen',
        ),
        array(
            'X3225216',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/Nørre Asmindrup 1892-1915 005.jpg',
            'jpg',
            'KB-1893-D: Nørre Asmindrup; Ludvig Rasmussen (Kontraministerialbogen)',
        ),
        array(
            'X3225217',
            'Images/Personer/sibastgrete2002.jpg',
            'jpg',
            'Grete Sibast, nee Møller (1947 - 2010)',
        ),
        array(
            'X3225218',
            'Images/Lokaliteter/Bormholm/Øster herred/Østerlars/Huset Åløsevej.JPG',
            'JPG',
            'Huset Åløsevej 6, Østerlars',
        ),
        array(
            'X3225219',
            'Images/Gravsten/Grete Sibast.JPG',
            'JPG',
            'Grete Sibast, f. Møller (1947 - 2010)',
        ),
        array(
            'X3225220',
            'Images/Lokaliteter/Bormholm/Vester herred/Rønne/data_kirkeboeger1892_099_3_041_0220a-FK.Jpg',
            'Jpg',
            'KB-1947-D-Rønne: Grete Møller',
        ),
        array(
            'X3225221',
            'Images/Lokaliteter/Bormholm/Vester herred/Rønne/data_kirkeboeger1892_099_3_043_0150a-FK.Jpg',
            'Jpg',
            'KB-1951-D-Rønne: Bodil Møller (1951 - )',
        ),
        array(
            'X3225222',
            'Images/Personer/Peder Rasmussen.jpg',
            'jpg',
            'Peder Rasmussen',
        ),
        array(
            'X3225223',
            'Images/Lokaliteter/Holbæk/Odsherred/Nykøbing Sjælland/Algade/Ahlgade Nykøbing Sjælland.jpg',
            'jpg',
            "Peder Rasmussen's Tricotage og Herreekviperingsforretning, Nykøbing Sj",
        ),
        array(
            'X3225224',
            'Images/Lokaliteter/Holbæk/Odsherred/Nykøbing Sjælland/Algade/Algade 31.jpg',
            'jpg',
            "Peder Rasmussen's Tricitage og Herreekviperingsforretning, Algade 31, Nykøbing Sjælland",
        ),
        array(
            'X3225225',
            'Images/Documenter/Peder Rasmussen/2014-10-23 16.26.05.jpg',
            'jpg',
            'Annonce, Nykøbing Dagblad',
        ),
        array(
            'X3225226',
            'Images/Documenter/Peder Rasmussen/2014-10-23 16.27.41.jpg',
            'jpg',
            'Annonce - Nykøbing Dagblad',
        ),
        array(
            'X3225227',
            'Images/Documenter/Peder Rasmussen/2014-10-23 16.21.13.jpg',
            'jpg',
            'Annonce, Nykøbing Dagblad',
        ),
        array(
            'X3225228',
            'Images/Personer/Dødsannonce Peter Rasmussen 1850-1917.jpg',
            'jpg',
            'Dødsannonce Holbæk Amts Venstreblad',
        ),
        array(
            'X3225229',
            'Images/Documenter/Peder Rasmussen/2014-10-23 16.39.37.jpg',
            'jpg',
            'Bekendtgørelse - Nykøbing Dagblad',
        ),
        array(
            'X3225230',
            'Images/Gravsten/Gravsted Peder Rasmussen.jpg',
            'jpg',
            'Peder Rasmussen (1850-1917)',
        ),
        array(
            'X3225231',
            'Images/Lokaliteter/Holbæk/Odsherred/Nykøbing Sjælland/data_SkifteMatr_S59-00028_A00667_S59-28_0464.Jpg',
            'Jpg',
            'Skifte efter Peder Rasmussen (1850-1917)',
        ),
        array(
            'X3225232',
            'Images/Personer/Peter Rasmussen/Peter Rasmussen - Dødsannonce.jpg',
            'jpg',
            'Peter Rasmussen - Bekendtgørelse',
        ),
        array(
            'X3225233',
            'Images/Personer/Peter Rasmussen - Tak.jpg',
            'jpg',
            'Peter Rasmussen - Tak for deltagelse',
        ),
        array(
            'X3225234',
            'Images/Personer/Peter Rasmussen/Peter Rasmussen - Annonce.jpg',
            'jpg',
            'Peter Rasmussen: Annoncer',
        ),
        array(
            'X3225235',
            'Images/Lokaliteter/Holbæk/Odsherred/Vig/KB-1850-D  Peter Rasmussen.jpg',
            'jpg',
            'KB-1850-D: Vig; Peter Rasmussen',
        ),
        array(
            'X3225236',
            'Images/Lokaliteter/Holbæk/Odsherred/Nykøbing Sjælland/Nykøbing Sjælland Byfoged/Realregister - Bygrunde (1850-1940) 016.jpg',
            'jpg',
            'Realregister - bygrunde, Matr nr 14',
        ),
        array(
            'X3225237',
            'Images/Lokaliteter/Holbæk/Odsherred/Nykøbing Sjælland/Nykøbing Sjælland Byfoged/Realregister - Bygrunde (1850-1940) 113.jpg',
            'jpg',
            'Realregister - Bygrunde, matr nr 110a',
        ),
        array(
            'X3225238',
            'Images/Lokaliteter/Holbæk/Odsherred/Nykøbing Sjælland/Nykøbing Sjælland Byfoged/Skøde og Panteprotokol 1908-1914 161.jpg',
            'jpg',
            'Skøde mv, Nykøbing Sj bygrunde matr nr 14 og 110a (1/2)',
        ),
        array(
            'X3225239',
            'Images/Lokaliteter/Holbæk/Odsherred/Nykøbing Sjælland/Nykøbing Sjælland Byfoged/Skøde og Panteprotokol 1908-1914 162.jpg',
            'jpg',
            'Skøde mv, Nykøbing Sj bygrunde matr nr 14 og 110a (2/2)',
        ),
        array(
            'X3225240',
            'Images/Lokaliteter/Holbæk/Odsherred/Nykøbing Sjælland/Nykøbing Sjælland Byfoged/Realregister - Bygrunde (1850-1940) 042.jpg',
            'jpg',
            'Realregister, Bygrunde Matr nr 13b',
        ),
        array(
            'X3225241',
            'Images/Lokaliteter/Holbæk/Odsherred/Nykøbing Sjælland/Nykøbing Sjælland Byfoged/Skøde og Panteprotokol 1908-1914 II 011.jpg',
            'jpg',
            'Skøde mv 13b',
        ),
        array(
            'X3225242',
            'Images/Lokaliteter/Holbæk/Odsherred/Nykøbing Sjælland/Nykøbing Sjælland Byfoged/Skøde og Panteprotokol 1908-1914 II 012.jpg',
            'jpg',
            'Skøde mv, Matr 13b',
        ),
        array(
            'X3225243',
            'Images/Lokaliteter/Holbæk/Odsherred/Nykøbing Sjælland/Skifte Peter Rasmussen/data_SkifteMatr_S59-00028_A00667_S59-28_0464.Jpg',
            'Jpg',
            'Skifte efter Peder Rasmussen (1850-1917)',
        ),
        array(
            'X3225244',
            'Images/Personer/Cecilie Kristiane Larsen 1922-07-15.jpg',
            'jpg',
            'Cecilie Kristiane Rasmussen f. Larsen',
        ),
        array(
            'X3225245',
            'Images/Personer/Cecilie Kristiane Larsen plus Inger Margrethe Rasmussen.jpg',
            'jpg',
            'Cecilie Kristiane Rasmussen f. Larsen (th) & Inger Margrethe Rasmussen (tv)',
        ),
        array(
            'X3225246',
            'Images/Personer/Olaf Rasmussen - Celilie Kristiane Rasmussen.jpg',
            'jpg',
            'Olaf Rasmussen (m) - Cecilie Kristiane Larsen (tv)',
        ),
        array(
            'X3225247',
            'Images/Personer/Cecilie Kristiane Rasmussen med flere 001.jpg',
            'jpg',
            'Cecilie Kristiane Larsen med datteren Inger Margrete og børnebørnene Peter og Egon',
        ),
        array(
            'X3225248',
            'Images/data_folketaelling_FT1925_0083_00052.jpg',
            'jpg',
            'FT-1925: Cecilie Christiane Rasmussen med familie',
        ),
        array(
            'X3225249',
            'Images/Documenter/Kristiane Rasmussen/2014-10-23 17.27.52.jpg',
            'jpg',
            'Bekendtgørelse - Holbæk Amts Venstreblad',
        ),
        array(
            'X3225250',
            'Images/Lokaliteter/Holbæk/Odsherred/Nykøbing Sjælland/Nykøbing Sjælland Byfoged/Realregister - Bygrunde (1850-1940) 016.jpg',
            'jpg',
            'Nykøbing Sjælland Byfoged, Realregister',
        ),
        array(
            'X3225251',
            'Images/Lokaliteter/Holbæk/Odsherred/Nykøbing Sjælland/Nykøbing S 1959D-1964D 155.jpg',
            'jpg',
            'KB-1960-B: Nykøbing Sjælland; Cecilie Christiane Rasmussen f Larsen',
        ),
        array(
            'X3225252',
            'Images/Lokaliteter/Holbæk/Odsherred/Asnæs/Asnæs 1807-1842 005.jpg',
            'jpg',
            'KB-1812-D: Asnæs; Rasmus Jensen',
        ),
        array(
            'X3225253',
            'Images/Lokaliteter/Holbæk/Odsherred/Asnæs/Asnæs 1810-1851 006.jpg',
            'jpg',
            'KB-1812-D: Asnæs; Rasmus Jensen',
        ),
        array(
            'X3225254',
            'Images/Lokaliteter/Holbæk/Odsherred/Højby/Maren Nielsdatter/data_SkifteMatr_S59-00140_A00180_S59-140_0194.Jpg',
            'Jpg',
            'Dødsanmeldelse: Maren Nielsdatter (1815 - 1890)',
        ),
        array(
            'X3225255',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/data_folketaelling_FT1860_00020_00992.jpg',
            'jpg',
            'FT-1860: Nørre Asmindrup: Maren Nielsdatter',
        ),
        array(
            'X3225256',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/data_folketaelling_FT1870_0062_01178.jpg',
            'jpg',
            'FT-1870: Nørre Asmindrup: Maren Nielsen',
        ),
        array(
            'X3225257',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/data_folketaelling_FT1880_10086_01416.jpg',
            'jpg',
            'FT-1880: Nørre Asmindrup; Maren Nielsen',
        ),
        array(
            'X3225258',
            'Images/Lokaliteter/Holbæk/Odsherred/Højby/data_SkifteMatr_S59-00140_A00180_S59-140_0194.Jpg',
            'Jpg',
            'Dødsanmeldelse: Maren Nielsdatter (1815-1890)',
        ),
        array(
            'X3225259',
            'Images/Personer/Johan Larsen.jpg',
            'jpg',
            'Johan Larsen (1824-1912)',
        ),
        array(
            'X3225260',
            'Images/Documenter/Johan Larsen/2014-10-23 16.59.26.jpg',
            'jpg',
            'Bekendtgørelse - Nykøbing Dagblad',
        ),
        array(
            'X3225261',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/data_SkifteMatr_S59-00141_A00183_S59-141_0589.Jpg',
            'Jpg',
            'Dødsanmeldelse: Johan Larsen (1824-1912)',
        ),
        array(
            'X3225262',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/Johan Larsen/data_SkifteMatr_S59-00029_A00111_S59-29_0363.Jpg',
            'Jpg',
            'Skifte (pg 1) efter Johan Larsen (1824-1912)',
        ),
        array(
            'X3225263',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/Johan Larsen/data_SkifteMatr_S59-00029_A00111_S59-29_0409.Jpg',
            'Jpg',
            'Skifte (pg 2) efter Johan Larsen (1824-1912)',
        ),
        array(
            'X3225264',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/Johan Larsen/data_SkifteMatr_S59-00029_A00111_S59-29_0410.Jpg',
            'Jpg',
            'Skifte (pg 3) efter Johan Larsen (1824-1912)',
        ),
        array(
            'X3225265',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/Johan Larsen/data_SkifteMatr_S59-00029_A00111_S59-29_0482.Jpg',
            'Jpg',
            'Skifte (pg 4) efter Johan Larsen (1824-1912)',
        ),
        array(
            'X3225266',
            'Images/Personer/Johan Larsen/Johan Larsen - Annonce 1863.jpg',
            'jpg',
            'Johan Larsen - Annonce 1863',
        ),
        array(
            'X3225267',
            'Images/Personer/Johan Larsen/Johan Larsen - Annonce 1881.jpg',
            'jpg',
            'Johan Larsen - Annonce 1881',
        ),
        array(
            'X3225268',
            'Images/Personer/Johan Larsen/Johan Larsen - Annonce 1877.jpg',
            'jpg',
            'Johan Larsen: Annonce 1877',
        ),
        array(
            'X3225269',
            'Images/Personer/Johan Larsen/Johan Larsen - Annonce 1877 Pattegrise.jpg',
            'jpg',
            'Johan Larsen: Annonce 1877',
        ),
        array(
            'X3225270',
            'Images/Personer/Johan Larsen/Johan Larsen - Annonce 1879.jpg',
            'jpg',
            'Johan Larsen: Annonce 1879',
        ),
        array(
            'X3225271',
            'Images/Lokaliteter/Holbæk/Odsherred/Højby/data_kirkeboegerM_368_3_003_007211023_00062.Jpg',
            'Jpg',
            'KB-1824-D: Højby; Johan Larsen',
        ),
        array(
            'X3225272',
            'Images/Lokaliteter/Holbæk/Odsherred/Dragsholm Birk/Skøde og Panteprotokol 1852-04-23 1856-01-11 514.jpg',
            'jpg',
            'Dragsholm Birk: Skøde og Panteprotokol: Skaverup Matr nr 18',
        ),
        array(
            'X3225273',
            'Images/Lokaliteter/Holbæk/Odsherred/Dragsholm Birk/Realregister - Nørre Asmindrup 1830-1940 187.jpg',
            'jpg',
            'Dragsholm Birk, Realregister: Skaverup Matr nr 18',
        ),
        array(
            'X3225274',
            'Images/Lokaliteter/Holbæk/Odsherred/Dragsholm Birk/Realregister - Nørre Asmindrup 1830-1940 037.jpg',
            'jpg',
            'Dragsholm Birk: Realregister - Nørre Asmindrup 1830-1940,',
        ),
        array(
            'X3225275',
            'Images/Lokaliteter/Holbæk/Odsherred/Dragsholm Birk/Skøde og Panteprotokol 1900-7-6 1906-6-14 243.jpg',
            'jpg',
            'Skøde: Svinninge Matr nr 4a (1/4)',
        ),
        array(
            'X3225276',
            'Images/Lokaliteter/Holbæk/Odsherred/Dragsholm Birk/Skøde og Panteprotokol 1900-7-6 1906-6-14 244.jpg',
            'jpg',
            'Skøde: Svinninge Matr nr 4a (2/4)',
        ),
        array(
            'X3225277',
            'Images/Lokaliteter/Holbæk/Odsherred/Dragsholm Birk/Skøde og Panteprotokol 1900-7-6 1906-6-14 245.jpg',
            'jpg',
            'Skøde: Svinninge Matr nr 4a (3/4)',
        ),
        array(
            'X3225278',
            'Images/Lokaliteter/Holbæk/Odsherred/Dragsholm Birk/Skøde og Panteprotokol 1900-7-6 1906-6-14 246.jpg',
            'jpg',
            'Skøde: Svinninge Matr nr 4a (4/4)',
        ),
        array(
            'X3225279',
            'Images/Lokaliteter/Holbæk/Odsherred/Dragsholm Birk/Realregister - Nørre Asmindrup 1830-1940 098.jpg',
            'jpg',
            'Svinninge Matr nr 5d',
        ),
        array(
            'X3225280',
            'Images/Lokaliteter/Holbæk/Odsherred/Dragsholm Birk/Skøde og Panteprotokol 1870 1872 246.jpg',
            'jpg',
            'Skøde mv på Svinninge Matr 5d',
        ),
        array(
            'X3225281',
            'Images/Lokaliteter/Holbæk/Odsherred/Dragsholm Birk/Skøde og Panteprotokol 1870-2-11 1872-7-19 247.jpg',
            'jpg',
            'Skøde mv på Svinninge Matr 5d',
        ),
        array(
            'X3225282',
            'Images/Lokaliteter/Holbæk/Odsherred/Dragsholm Birk/Realregister - Nørre Asmindrup 1830-1940 102.jpg',
            'jpg',
            'Svinninge Matr nr 4e',
        ),
        array(
            'X3225283',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/data_folketaelling_FT1880_10086_01443.Jpg',
            'Jpg',
            'FT-1880: Nørre Asmindrup sogn; Johan Larsen',
        ),
        array(
            'X3225284',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/Nørre Asmindrup 1892-1915 211.jpg',
            'jpg',
            'KB-1911-B: Nørre Asmindrup; Johan Larsen',
        ),
        array(
            'X3225285',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/data_SkifteMatr_S59-00141_A00183_S59-141_0589.Jpg',
            'Jpg',
            'Skifte efter Johan Larsen (1824-1912)',
        ),
        array(
            'X3225286',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/Johan Larsen/data_SkifteMatr_S59-00029_A00111_S59-29_0363.Jpg',
            'Jpg',
            'Skifte efter Johan Larsen (1824-1912) - Side 1/4',
        ),
        array(
            'X3225287',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/Johan Larsen/data_SkifteMatr_S59-00029_A00111_S59-29_0409.Jpg',
            'Jpg',
            'Skifte efter Johan Larsen (1824-1912) - Side 2/4',
        ),
        array(
            'X3225288',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/Johan Larsen/data_SkifteMatr_S59-00029_A00111_S59-29_0410.Jpg',
            'Jpg',
            'Skifte efter Johan Larsen (1824-1912) - Side 3/4',
        ),
        array(
            'X3225289',
            'Images/Lokaliteter/Holbæk/Odsherred/Nørre Asmindrup/Johan Larsen/data_SkifteMatr_S59-00029_A00111_S59-29_0482.Jpg',
            'Jpg',
            'Skifte efter Johan Larsen (1824-1912) - Side 4/4',
        ),
    );

    const SOURCE = array(
        array(
            'Author',
            'Title',
            'Abbreviation',
            'Publication',
            'Text'
        ),
        array(
            'Henning Henningsen',
            '"Papegøje og Vippefyr": Det danske fyrvæsen indtil 1770',
            'Abbreviation',
            '"Handels- og Søfartsmuseet på Kronborg. Årbog" 1960;1-40',
            'Text'
        ),
        array(
            'G.L. Dam og H.K. Larsen',
            'Aakirkeby, 1346-1946',
            'Abbreviation',
            'http://bornholmske-samlinger.dk/wp-content/uploads/2014/10/1346-1946-Aakirkeby.pdf',
            'Text'
        ),
        array(
            'Andersen, Axel',
            'Assistens Kirkegaard, København',
            'Abbreviation',
            'Assistens Kirkegårds Formidlingscenter, 1993.',
            'En lille Tekst'
        ),
    );

    /**
    * function load
    */

    public function load( ObjectManager $manager ): void {
        // USER

        foreach ( self::USERNAME as $name ) {

            $user = new User();
            $user->setUsername( $name );
            $user->setPassword( self::PASSWORD );
            $user->setRoles( self::ROLES );
            $manager->persist( $user );
        }

        // PROJECT

        foreach ( self::PROJECT as $url ) {
            $project = new Project();
            $project->setUrl( $url );
            $project->setTitle( $url );
            $manager->persist( $project );
            $manager->flush();

            $this->individual( $project, $manager );
            $this->family( $project, $manager );
            $this->media( $project, $manager );
            $this->submitterRecord( $project, $manager );
            $this->repositoryRecord( $project, $manager );
            $this->sourceRecord( $project, $manager );

            $manager->persist( $project );
        }

        //$record = new MediaRecord();
        //$manager->persist( $record );

        $manager->flush();
    }

    /**
    *  function individual
    */

    private function individual( $project, ObjectManager $manager ) {
        foreach ( self::INDIVIDUAL as $individual ) {
            $indi = new Individual();
            $p = $indi->getNames()->first()->getNamePieces();
            $p->setSpfx( 'von' );
            $p->setGivn( 'Anders' );
            $p->setSurn( 'And' );

            //$ref = new FileReference();
            //$ref->setTitle( $media[ 0 ] );

            //$record->addFileReference( $ref );
            $project->addIndividual( $indi );
            $manager->persist( $indi );

            foreach ( self::NAME as $name ) {
                $n = new NameStructure();
                $p = $n->getNamePieces();
                $p->setGivn( 'Anders' );
                $p->setSurn( 'And' );
                $manager->persist( $n );
                $indi->addName( $n );
            }
            $manager->persist( $indi );
            $manager->flush();

        }

    }

    private function family( $project, ObjectManager $manager ) {
        foreach ( self::FAMILY as $family ) {
            $fam = new Family();
            $project->addFamily( $fam );
            $manager->persist( $fam );
        }
    }

    /**
    *  function media
    */

    private function media( $project, ObjectManager $manager ) {
        foreach ( self::MEDIA as $media ) {
            $record = new MediaRecord();
            $record->setXref( $media[ 0 ] );
            $reference = new FileReference();
            $reference->setTitle( $media[ 3 ] );
            $record->addFileReference( $reference );
            $element = new MediaElement();
            $element->setFormat( $media[ 2 ] );
            $element->setFile( $media[ 1 ] );
            $reference->addMediaElement( $element );
            //$ref = new FileReference();
            //$ref->setTitle( $media[ 0 ] );

            //$record->addFileReference( $ref );
            $project->addMediaRecord( $record );
            $manager->persist( $record );
        }

    }

    /**
    *  function submitterRecords()
    */

    private function submitterRecord( $project, ObjectManager $manager ) {
        foreach ( self::SUBMITTER as $submitter ) {
            $record = new SubmitterRecord();
            //$ref = new FileReference();
            //$ref->setTitle( $media[ 0 ] );

            //$record->addFileReference( $ref );
            $project->addSubmitterRecord( $record );
            // $manager->persist( $project );
            $manager->persist( $record );
        }

    }

    /**
    *  function repositoryRecords()
    */

    private function repositoryRecord( $project, ObjectManager $manager ) {
        foreach ( self::REPOSITORY as $repos ) {
            $record = new RepositoryRecord();
            $record->setName( $repos );
            //$ref = new FileReference();
            //$ref->setTitle( $media[ 0 ] );

            //$record->addFileReference( $ref );
            // $manager->persist( $record );
            $project->addRepositoryRecord( $record );
            // $manager->persist( $project );
            // $manager->persist( $record );
        }

        for ( $i = 1; $i < 1000; $i++ ) {
            $record = new RepositoryRecord();
            $record->setName( 'Repository #'.$i );
            $project->addRepositoryRecord( $record );

        }

    }
    /**
    *  function repositoryRecords()
    */

    private function sourceRecord( $project, ObjectManager $manager ) {
        foreach ( self::SOURCE as $src ) {
            $rec = new SourceRecord();
            $rec->setAuthor( $src[ 0 ] );
            $rec->setTitle( $src[ 1 ] );
            $rec->setAbbreviation( $src[ 2 ] );
            $rec->setPublication( $src[ 3 ] );
            // $rec->setText( $src[ 4 ] );

            //$manager->persist( $rec );

            //$record->addFileReference( $ref );
            $project->addSourceRecord( $rec );
            //$manager->persist( $rec );
            //$manager->persist( $rec );

        }
        //$manager->persist( $project[ 0 ] );

        //$manager->flush();
    }
}
