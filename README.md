# OsztottProjekt
Számítástechnika III. A. Elosztott szavazórendszer megvalósítása

!!! Initial branchre töltsétek fel ami van eddig. Ha nem lehet akkor új saját branchre.

Tanár dokumentuma: https://docs.google.com/document/d/1Kf0Xf_AVWoobFlTRmfs_ItwHYL4bzcz_BPQfZn9Pxjc/edit

Adatbazis tablak: https://dbdiagram.io/d/6465bd4ddca9fb07c44d802c
 - Ezekkel a táblákkal dolgozunk, ha van javaslat javításra meghallgatom.

A feladat struktúráját feltöltöttem a repoba, schema.png.

!!! Feladatot a jobb átláthatóság miatt érdemes a project szekcióban és commit alkalmával dokumentálni.

Display app-hoz python 3.9 ajánlott! pip install wxpython, pip install portalocker stb.

Adatbázinak MongoDB-t használunk. Szerver-t PHP-ban írjuk meg. Design HTML+CSS+JS.

A ppt.t csatolom abba rakjátok be a saját részeteket, 2-3 slide.

A feladat a szavazórendszer megvalósítása. 
 - Kliens regisztráció -> login
 - Kérdés/Szavazás kiküldése az érintett klienseknek
 - Válaszok fogadása a kliensektől
 - Válaszok kiértékelése és kivetítése
A kérdés kiküldése után a képernyőn legyen látható a szavazás állapota(hányan szavaztak pl).
Csak az szavazhat/válaszolhat aki be van jelentkezve és meg van jelölve az adott szavazásra.

Az adatbázisban el lesz tárolva a szavazás kérdése, a válaszok és a kliensek adatai.

(Code view-ben átláthatóbb)

Név:          Feladat:                                            

Kállai Balázs   12,13 - Lekérdezés kliensről, design                

Magyar Roland   3,4 - Web RPC(adatbázis), szerver oldal             

Iszlai Tamás    11,14 - Kliens, Bejelentkezés/Regisztráció          

Bíró Apor       9,10 - Adatbázis                                    

Lőrinczi Mátyás 7,8 - Kijelző alkalmazás                            

Török Hunor     5,6 - Szerver oldal, Web RPC(kijelzőre)             

Veres Tivadar   1,2 - Szerver alkalmazás                            

