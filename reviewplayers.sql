-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 04, 2021 alle 14:25
-- Versione del server: 10.4.17-MariaDB
-- Versione PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reviewplayers`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news_autore` varchar(40) NOT NULL DEFAULT '',
  `news_titolo` varchar(100) NOT NULL DEFAULT '',
  `news_articolo` text NOT NULL,
  `news_immagini` varchar(200) NOT NULL DEFAULT '',
  `news_data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `news`
--

INSERT INTO `news` (`news_id`, `news_autore`, `news_titolo`, `news_articolo`, `news_immagini`, `news_data`) VALUES
(1, 'simo0734', 'Control ultimate edition gratis con PsPlus', 'Tra i nuovi giochi gratis di Playstation Plus, rientra anche Control Ultimate Edition, uno sparatutto in terza persona basato sul paranormale. Durante i saldi di fine anno del PlayStation, Store Control Ultimate Edition è stato proposto a prezzo scontato e molti hanno dunque comprato il gioco in attesa dell\'aggiornamento in arrivo il 2 febbraio. La notizia dell\'arrivo nella lineup PS Plus di febbraio infatti, ha scontentato proprio coloro che hanno comprato la Ultimate Edition di Control da pochi giorni.Per quanto una reazione di questo tipo sia comprensibile, non si può esattamente dare la colpa a 505 Games, di certo non per aver stretto un accordo con Sony per l\'inserimento di Control Ultimate Edition nel PS Plus di febbraio 2021. Inoltre, bisogna ricordare che, nel caso nel quale si disdica l\'abbonamento, si perderebbe l\'accesso al gioco: l\'acquisto invece è definitivo. ', 'control.jpg', '2021-02-03'),
(2, 'leo227', 'PS5', 'Nel presentare i risultati finanziari dell\'ultimo trimestre, la dirigenza della compagnia nipponica ha promesso un incremento degli sforzi produttivi, che dovrebbe tradursi in 3 milioni di ulteriori PlayStation 5 in arrivo sugli scaffali entro il 31 marzo 2021. L\'obiettivo è quello di chiudere l\'anno fiscale corrente con un totale di console distribuite che possa eguagliare quanto fatto da Sony in occasione del lancio di PlayStation 4. Non sono tuttavia stati offerti dettagli su quelle che saranno le aree geografiche privilegiate per la distribuzione di nuove scorte di PS5, la cui domanda resta elevata in tutta Europa, ma anche in Nord America, Giappone e non solo. Per adesso l\'unico modo per poter prenotare una Playstation 5 è farlo online, tramite Amazon, Mediaworld ed Unieuro, che apriranno senza preavviso i pre-order, perciò bisogna essere abbastanza veloci nel farlo.', 'ps5.jpg', '2021-02-03'),
(3, 'gianfry097', 'EPIC STORE REGALA GIOCO PC', 'Come ogni giovedì Epic Games Store regala un nuovo gioco per PC, disponibile da oggi alle 17:00 (ora italiana) e fino alla stessa ora dell\'11 febbraio. Come di consueto, una volta riscattato il gioco resterà vostro per sempre e potrete utilizzarlo senza limitazioni. Si tratta di For The King, descritto come \"un avvincente mix di strategia, combattimento a turni ed elementi roguelike. Ogni partita è unica, grazie a mappe procedurali, missioni ed eventi. Esplora Fahrul in modalità giocatore singolo, coop in locale o online.\" E\' possibile scaricare il gioco direttamente dal sito della Epic Games Store.For The King è certamente un titolo da non sottovalutare e il fatto che sia offerto gratis da Epic Games Store aiuterà sicuramente il team di sviluppo ad espandere la fanbase.', 'epic.png', '2021-02-04'),
(4, 'gianfry097', 'Prince of Persia remake rinviato', 'Il remake di Prince of Persia: Le Sabbie del Tempo, un progetto con cui Ubisoft tenta di riportare in vita un gran gioco ps2/xbox, dopo essere stato rinviato da gennaio (lancio originale) è stato nuovamente rinviato a marzo per rispondere ai feedback non proprio esaltanti da parte dei fan della saga. L\'azienda ha rinviato a data da destinarsi il rifacimento per poter lavorare al meglio sul progetto e \"creare un remake che rimanga fresco senza perdere attinenza con l\'originale\". Senza una finestra di lancio ben definita, sembra chiaro che Ubisoft voglia concedere ai due team di Mumbai e Pune tutto il tempo necessario a rivedere ciò che non ha convinto i fan dopo la prima apparizione. A partire dallo stile grafico, apparso eccessivamente caricaturale rispetto all\'originale, fino ad alcune scelte di design che non sembrano rispettare adeguatamente la tradizione della serie.', 'princeofpersia.jpg', '2021-02-08'),
(5, 'simo0734', 'Cod Warzone - Glitch per utilizzare la sykov, non ancora disponibile', 'Sebbene non si conoscano ancora i dettagli della Stagione 2 di Call of Duty Warzone e Black Ops Cold War, sappiamo che tra le armi presenti nel codice dello sparatutto e ancora da pubblicare vi sia Sykov, una pistola che i fan stanno aspettando per via delle sue caratteristiche. Sfruttando un glitch nella modalità Malloppo, è possibile entrare in possesso della Sykov in partita e ad utilizzarla contro altri giocatori. L\'arma è infatti presente nel gioco per i soli possessori di Modern Warfare su PlayStation 4 (si tratta di un progetto disponibile in esclusiva temporale sulla console Sony) e non potrebbe essere utilizzata al di fuori della modalità Sopravvivenza. L\'arma sta stuzzicando l\'interesse di tutti i giocatori del battle royale per via della possibilità di essere personalizzata con un generoso caricatore e per via della presenza della modalità akimbo: insieme, questi due elementi potrebbero rendere la Sykov un\'arma particolarmente efficace e non è da escludere che al debutto possa entra', 'sykov.jpg', '2021-02-12'),
(6, 'giando00', 'Oddworld Soulstorm', 'È ufficiale: durante lo State of Play, è stato confermato che Oddworld: Soulstorm uscirà il 6 aprile su PS4 e PS5. Come se non bastasse, è giunta anche la lieta notizia che l’edizione PS5 sarà offerta gratuitamente agli iscritti PlayStation Plus dal 6 aprile al 3 maggio. Questo nuovo capitolo funge da ripartenza per l’amatissima saga, il cui primo capitolo, Oddworld: Abe’s Oddysee, è un classico per la prima, intramontabile PlayStation (e anche su PC). Essendo di fatto un reboot, la storia avrà dei punti in comune con l’originale ma sarà completamente rinfrescata ed approfondita con un taglio più cinematografico, ponendo una maggiore attenzione sull’universo di Abe.La stessa cosa vale per le meccaniche, fortemente ispirate a quelle del gioco del ‘97, ma migliorate ed espanse anche e soprattutto a livello tecnologico, con enigmi e sequenze più ricche di oggetti con cui interagire, e soprattutto con ambienti molto più grandi. La versione PC sarà un’esclusiva Epic Games Store e sarà pubblicata lo stesso giorno delle edizioni console al prezzo di 49,99€.', 'oddworld.jpg', '2021-02-27'),
(7, 'Giando00', 'Dying Light 2 - Evento sorpresa', 'L’annuncio di Dying Light 2 risale ormai al 2018, e negli ultimi anni le notizie sul gioco si sono fatte sempre più rade, con pochi aggiornamenti tangibili sullo stato di salute del titolo di Techland. Finalmente mercoledì 17 marzo Techland pubblicherà un Dev Update di Dying Light 2 con l\'obiettivo di aggiornare la community sullo sviluppo. Non si parlerà, ribadisce Uncy, della data di uscita del gioco e non ci sono piani per lanciare Dying Light 2 in Early Access. Inoltre, viene confermato come Dying Light 2 non sia stato cancellato, i lavori proseguono e non ci sono particolari problemi, semplicemente il titolo è stato mostrato troppo presto al pubblico e questo ha generato un enorme hype con conseguente lunga attesa. C\'è chi ipotizza la cancellazione delle versioni old-gen a vantaggio di uno sviluppo orientato alle sole piattaforme PC, PS5 e Xbox Series X/S, Uncy non ha però voluto dire di più invitando a restare sintonizzati il 17 marzo per novità sul progetto. ', 'dying light.jpg', '2021-03-15');

-- --------------------------------------------------------

--
-- Struttura della tabella `recensioni`
--

CREATE TABLE `recensioni` (
  `rec_id` int(11) NOT NULL,
  `rec_autore` varchar(40) NOT NULL DEFAULT '',
  `rec_titolo` varchar(100) NOT NULL DEFAULT '',
  `rec_articolo` text NOT NULL,
  `rec_immagini` varchar(200) DEFAULT NULL,
  `rec_data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `recensioni`
--

INSERT INTO `recensioni` (`rec_id`, `rec_autore`, `rec_titolo`, `rec_articolo`, `rec_immagini`, `rec_data`) VALUES
(1, 'gianfry097', 'SPIDERMAN - MILES MORALES', 'Spider-Man Miles Morales è l’ultima fatica di Insomniac Games, nato come semplice espansione di Spider-Man, nel tempo si è trasformato come capitolo Stand Alone. In questa nuova avventura vestiremo i panni di Miles, il giovane ragazzo che faceva da secondario a Peter Parker nel precedente capitolo. La trama, seppure breve (all’incirca sulle cinque ore), è ben strutturata e piacevole da giocare, ed a questo si collega il secondo punto: i personaggi ben caratterizzati. Il Gameplay è leggermente migliorato rispetto al titolo precedente ma non rivoluzionato. Purtroppo però ci sono anche dei difetti, seppur ci siano alcuni nuovi tipi di missioni secondarie ce ne sono altre uguali al vecchio Spider-Man che danno un senso di ripetitività parecchio frustrante. Secondo la nostra opinione avrebbe avuto più senso diminuire le secondarie e fare un gioco leggermente più corto ma più godibile, ovviamente facendolo pagare meno.', 'spiderman.jpg', '2021-04-20'),
(2, 'simo0734', 'demon\'s souls', 'A livello ludico, Demon\'s Souls si presenta come un Action RPG impietoso, un gioco che richiede una dedizione incrollabile e un grande rigore. Bastano pochi colpi per incontrare un triste destino, martoriati dagli assalti violenti degli avversari, ed è quindi necessario procedere con estrema cautela. Le regole della progressione sono le stesse che in molti hanno imparato a conoscere con la trilogia dei Dark Souls, ma in questo episodio primordiale si rivelano addirittura più severe e inflessibili. Gli oggetti curativi, a differenza della fiaschetta Estus, si consumano, e recuperarli richiede una lunga operazione di accumulo. Nonostante la mole di contenuti di Demon\'s Souls non sia soverchiante, è quindi possibile dedicare al prodotto molto più tempo di quello necessario a vedere i titoli di coda, magari provando nuovi approcci con la magia o le armi da tiro, nel tentativo di vedere entrambi i finali disponibili.', 'demonssouls.jpg', '2021-04-20'),
(3, 'leo227', 'CRASH BANDICOOT 4 - IT\'S ABOUT TIME', 'Crash è sempre stato un campione di espressività, ed è sempre riuscito a raccontarsi benissimo, senza dire alcuna parola, sia con le animazioni che con il carisma dei nemici e delle ambientazioni. Crash Bandicoot 4 - It\'s about time, porta il tutto verso nuovi orizzonti con un\'estetica modernizzata rispetto a quello originale disegnato da Naughty Dog. It\'s About time punta al platforming nudo e crudo, presentando comunque un ottimo accostamento di situazioni. Lo fa innanzitutto con una migliore gestione dei controlli, più permissivi e meno legnosi rispetto al passato, con un doppio salto che consente di riposizionarsi, e delle collisioni meno scivolose, in special modo se rapportate a quelle del restauro della trilogia. Dopodiché vi sono le Maschere Quantiche, le quali aggiungono ulteriori variabili al disegno dei livelli: queste appaiono in precisi momenti, costruiti appunto attorno all’utilizzo della maschera. Se ne contano quattro in tutto. Crash Bandicoot 4: It’s About Time è un videogioco enorme, che a volte però rende il gioco molto difficoltoso.', 'crash.jpg', '2021-04-20'),
(4, 'giando00', 'destruction all star\'s', 'La Destruction AllStars che dà il nome al gioco PS5 è una competizione mondiale nella quale un gruppo di piloti si scontrano per la gloria e per lo spettacolo. Precisamente, avremo 16 \"eroi\" in attesa di scendere in campo: ognuno di essi ha un proprio passato, raccontato in poche righe, e soprattutto ha un proprio stile. Ognuno di essi è unico non solo per quanto riguarda il costume, ma anche in termini di animazioni. Sia tramite il menù di selezione che nell\'utilizzo nelle arene, possiamo capire se abbiamo di fronte una persona giocosa, una molto seria, qualcuno di schivo, insicuro o al contrario vanesio. Ovviamente conta anche che i piloti siano unici a livello di gameplay. Ogni personaggio dispone di un\'abilità e di un mezzo personale, che dispone a propria volta di un\'abilità dedicata. Di base Destruction AllStars è un gioco pensato per il multigiocatore. Il problema attuale è che Destruction AllStars non sembra pronto a sostenere il pubblico sul lungo periodo. Avrà bisogno di nuove modalità!', 'destruction.png', '2021-04-20'),
(5, 'gianfry097', 'Werewolf - the apocalypse', 'Werewolf è un gioco d\'azione con elementi stealth, dovremo infiltrarci di volta in volta negli stabilimenti della Endron. Qualora venissimo scoperti, però, non avremo altra scelta che ricorrere alla terza mutazione: Crinos, un mannaro da combattimento dalla potenza incalcolabile. Per la maggior parte dell\'avventura potremo agire in silenzio o attaccare a testa bassa, a seconda delle nostre preferenze o della nostra sete di sangue. In entrambi i casi, non mancano significativi problemi: anzitutto, le fasi stealth seguono pattern davvero antichissimi, con un level design privo di coerenza. Ne consegue che l\'approccio meno rumoroso, in cui dovremo anche disattivare all\'occorrenza telecamere e torrette, risulta davvero molto noioso e poco stimolante.Con una licenza di pregio come quella del World of Darkness, sarebbe stato legittimo ambire a traguardi più elevati. Werewolf The Apocalypse: Earthblood è invece un action game figlio di un tempo ormai troppo antico, impreciso nel gameplay, pigrissimo nella composizione dei livelli e molto fiacco nella progressione.', 'werewolf.jpg', '2021-04-20');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `permesso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `username`, `password`, `permesso`) VALUES
(1, 'gianfry097', '3087e1574e25ed9a903fe117e9188f2e', 1),
(2, 'simo0734', 'baefb88e33c95410004743f652d592f6', 0),
(3, 'giando00', 'af96400c33941256d13cef8f95f2e30a', 0),
(4, 'leo227', '10550feebcca58cc1abb45ddf56b25f0', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indici per le tabelle `recensioni`
--
ALTER TABLE `recensioni`
  ADD PRIMARY KEY (`rec_id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `recensioni`
--
ALTER TABLE `recensioni`
  MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
