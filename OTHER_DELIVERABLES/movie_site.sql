-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2021 at 11:06 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_site`
--

DROP SCHEMA IF EXISTS `movie_site`;
CREATE SCHEMA `movie_site`;
USE `movie_site`;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genreId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genreId`, `name`) VALUES
(1, 'Action'),
(2, 'Comedy'),
(3, 'Drama'),
(4, 'Fantasy'),
(5, 'Science Fiction'),
(6, 'Thriller'),
(7, 'Family'),
(8, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `historyItem`
--

CREATE TABLE `historyItem` (
  `historyItemId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `movieId` int(11) NOT NULL,
  `isReviewed` tinyint(1) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `historyItem`
--

INSERT INTO `historyItem` (`historyItemId`, `userId`, `movieId`, `isReviewed`, `date`) VALUES
(28, 1, 53, 1, '12/02/2021'),
(31, 27, 3, 1, '12/03/2021'),
(32, 27, 22, 1, '12/03/2021'),
(33, 27, 53, 1, '12/03/2021'),
(34, 27, 15, 1, '12/03/2021'),
(35, 26, 9, 1, '12/03/2021'),
(37, 26, 3, 1, '12/03/2021'),
(40, 39, 2, 1, '12/03/2021'),
(41, 28, 2, 1, '12/03/2021'),
(47, 28, 3, 1, '12/03/2021'),
(48, 28, 8, 1, '12/03/2021'),
(52, 1, 28, 1, '12/04/2021'),
(54, 1, 32, 0, '12/04/2021'),
(55, 1, 3, 1, '12/04/2021'),
(59, 28, 44, 1, '12/04/2021'),
(63, 30, 66, 1, '12/05/2021'),
(64, 30, 67, 1, '12/05/2021'),
(65, 30, 1, 1, '12/05/2021'),
(66, 30, 15, 1, '12/05/2021'),
(67, 39, 1, 1, '12/05/2021'),
(68, 1, 15, 1, '12/05/2021'),
(69, 1, 22, 1, '12/05/2021'),
(71, 1, 68, 1, '12/05/2021'),
(78, 26, 1, 1, '12/05/2021'),
(81, 42, 30, 1, '12/06/2021'),
(83, 1, 1, 1, '12/08/2021'),
(84, 26, 32, 1, '12/08/2021'),
(91, 42, 14, 1, '12/12/2021'),
(92, 39, 14, 1, '12/12/2021'),
(93, 44, 18, 1, '12/12/2021'),
(94, 44, 14, 1, '12/12/2021'),
(97, 44, 26, 1, '12/12/2021'),
(98, 27, 1, 1, '12/12/2021'),
(99, 1, 44, 0, '12/12/2021');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movieId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `averageScore` decimal(10,2) NOT NULL,
  `posterFile` varchar(255) NOT NULL,
  `genreId` int(11) NOT NULL,
  `synopsis` text NOT NULL,
  `year` int(11) NOT NULL,
  `maturityRating` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movieId`, `title`, `averageScore`, `posterFile`, `genreId`, `synopsis`, `year`, `maturityRating`) VALUES
(1, 'Star Wars: Episode IV - A New Hope', '8.83', 'a_new_hope.jpg', 5, 'The Imperial Forces, under orders from cruel Darth Vader (David Prowse), hold Princess Leia (Carrie Fisher) hostage, in their efforts to quell the rebellion against the Galactic Empire. Luke Skywalker (Mark Hamill) and Han Solo (Harrison Ford), captain of the Millennium Falcon, work together with the companionable droid duo R2-D2 (Kenny Baker) and C-3PO (Anthony Daniels) to rescue the beautiful princess, help the Rebel Alliance, and restore freedom and justice to the Galaxy.', 1977, 'PG'),
(2, 'The Godfather', '9.50', 'the_godfather.jpg', 3, 'Widely regarded as one of the greatest films of all time, this mob drama, based on Mario Puzo\'s novel of the same name, focuses on the powerful Italian-American crime family of Don Vito Corleone (Marlon Brando). When the don\'s youngest son, Michael (Al Pacino), reluctantly joins the Mafia, he becomes involved in the inevitable cycle of violence and betrayal. Although Michael tries to maintain a normal relationship with his wife, Kay (Diane Keaton), he is drawn deeper into the family business.', 1972, 'R'),
(3, 'Spider Man 2', '7.80', 'spider_man_2.jpg', 1, 'When a failed nuclear fusion experiment results in an explosion that kills his wife, Dr. Otto Octavius (Alfred Molina) is transformed into Dr. Octopus, a cyborg with deadly metal tentacles. Doc Ock blames Spider-Man (Tobey Maguire) for the accident and seeks revenge. Meanwhile, Spidey\'s alter ego, Peter Parker, faces fading powers and self-doubt. Complicating matters are his best friend\'s (James Franco) hatred for Spider-Man and his true love\'s (Kirsten Dunst) sudden engagement to another man.', 2004, 'PG-13'),
(4, 'The Shawshank Redemption', '-1.00', 'the_shawshank_redemption.jpg', 3, 'Andy Dufresne (Tim Robbins) is sentenced to two consecutive life terms in prison for the murders of his wife and her lover and is sentenced to a tough prison. However, only Andy knows he didn\'t commit the crimes. While there, he forms a friendship with Red (Morgan Freeman), experiences brutality of prison life, adapts, helps the warden, etc., all in 19 years.', 1994, 'R'),
(5, '2001: A Space Odyssey', '-1.00', '2001_a_space_odyssey.jpg', 5, 'An imposing black structure provides a connection between the past and the future in this enigmatic adaptation of a short story by revered sci-fi author Arthur C. Clarke. When Dr. Dave Bowman (Keir Dullea) and other astronauts are sent on a mysterious mission, their ship\'s computer system, HAL, begins to display increasingly strange behavior, leading up to a tense showdown between man and machine that results in a mind-bending trek through space and time.', 1968, 'G'),
(6, 'Indiana Jones and the Raiders of the Lost Ark', '-1.00', 'raiders_of_the_lost_ark.jpg', 1, 'The story introduces us to archaeologist and adventurer Indiana Jones (Harrison Ford), who is contacted by the government to go on a quest for the mystical lost Ark of the Covenant. Accompanied by his old friend Sallah (John Rhys-Davies) and ex-flame Marion Ravenwood (Karen Allen), he must retrieve the ark before the Nazis and his adversary, French archaeologist Rene Belloq (Paul Freeman) acquire it first.', 1981, 'PG'),
(7, 'Mad Max: Fury Road', '-1.00', 'mad_max_fury_road.jpg', 4, 'Haunted by his turbulent past, Mad Max believes the best way to survive is to wander alone. Nevertheless, he becomes swept up with a group fleeing across the Wasteland in a War Rig driven by an elite Imperator, Furiosa. They are escaping a Citadel tyrannized by the Immortan Joe, from whom something irreplaceable has been taken. Enraged, the Warlord marshals all his gangs and pursues the rebels ruthlessly in the high-octane Road War that follows.', 2015, 'R'),
(8, 'Avengers: Endgame', '9.00', 'avengers_endgame.jpg', 1, 'Adrift in space with no food or water, Tony Stark sends a message to Pepper Potts as his oxygen supply starts to dwindle. Meanwhile, the remaining Avengers -- Thor, Black Widow, Captain America and Bruce Banner -- must figure out a way to bring back their vanquished allies for an epic showdown with Thanos -- the evil demigod who decimated the planet and the universe.', 2019, 'PG-13'),
(9, 'Dunkirk', '9.00', 'dunkirk.jpg', 1, 'In May 1940, Germany advanced into France, trapping Allied troops on the beaches of Dunkirk. Under air and ground cover from British and French forces, troops were slowly and methodically evacuated from the beach using every serviceable naval and civilian vessel that could be found. At the end of this heroic mission, 330,000 French, British, Belgian and Dutch soldiers were safely evacuated.', 2017, 'PG-13'),
(10, 'Ferris Bueller\'s Day Off', '-1.00', 'ferris_buellers_day_off.jpg', 2, 'Ferris Bueller (Matthew Broderick) has an uncanny skill at cutting classes and getting away with it. Intending to make one last duck-out before graduation, Ferris calls in sick, borrows a Ferrari, and embarks on a one-day journey through the streets of Chicago. On Ferris\' trail is high school principal Rooney (Jeffrey Jones), determined to catch him in the act.', 1986, 'PG-13'),
(11, 'Fight Club', '-1.00', 'fight_club.jpg', 6, 'A depressed man (Edward Norton) suffering from insomnia meets a strange soap salesman named Tyler Durden (Brad Pitt) and soon finds himself living in his squalid house after his perfect apartment is destroyed. The two bored men form an underground club with strict rules and fight other men who are fed up with their mundane lives. Their perfect partnership frays when Marla (Helena Bonham Carter), a fellow support group crasher, attracts Tyler\'s attention.', 1999, 'R'),
(12, 'The Matrix', '-1.00', 'the_matrix.jpg', 5, 'Neo (Keanu Reeves) believes that Morpheus (Laurence Fishburne), an elusive figure considered to be the most dangerous man alive, can answer his question -- What is the Matrix? Neo is contacted by Trinity (Carrie-Anne Moss), a beautiful stranger who leads him into an underworld where he meets Morpheus. They fight a brutal battle for their lives against a cadre of viciously intelligent secret agents. It is a truth that could cost Neo something more precious than his life.', 1999, 'R'),
(13, 'WALL·E', '-1.00', 'walle.jpg', 7, 'WALL-E, short for Waste Allocation Load Lifter Earth-class, is the last robot left on Earth. He spends his days tidying up the planet, one piece of garbage at a time. But during 700 years, WALL-E has developed a personality, and he\'s more than a little lonely. Then he spots EVE (Elissa Knight), a sleek and shapely probe sent back to Earth on a scanning mission. Smitten WALL-E embarks on his greatest adventure yet when he follows EVE across the galaxy.', 2008, 'G'),
(14, 'Toy Story', '6.33', 'toy_story.jpg', 7, 'Woody (Tom Hanks), a good-hearted cowboy doll who belongs to a young boy named Andy (John Morris), sees his position as Andy\'s favorite toy jeopardized when his parents buy him a Buzz Lightyear (Tim Allen) action figure. Even worse, the arrogant Buzz thinks he\'s a real spaceman on a mission to return to his home planet. When Andy\'s family moves to a new house, Woody and Buzz must escape the clutches of maladjusted neighbor Sid Phillips (Erik von Detten) and reunite with their boy.', 1995, 'G'),
(15, 'Anchorman: The Legend of Ron Burgandy', '8.00', 'anchorman.jpg', 2, 'Hotshot television anchorman Ron Burgundy (Will Ferrell) welcomes upstart reporter Veronica Corningstone (Christina Applegate) into the male-dominated world of 1970s broadcast news -- that is, until the talented female journalist begins to outshine Burgundy on air. Soon he grows jealous, begins a bitter feud with Veronica and eventually makes a vulgar slip on live TV that ruins his career. However, when an outrageous story breaks at the San Diego Zoo, Ron may get a chance to redeem himself.', 2004, 'PG-13'),
(16, 'Parasite', '-1.00', 'parasite.jpg', 6, 'Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.', 2019, 'R'),
(17, 'Catch Met If You Can', '-1.00', 'catch_me.jpg', 3, 'Frank Abagnale, Jr. (Leonardo DiCaprio) worked as a doctor, a lawyer, and as a co-pilot for a major airline -- all before his 18th birthday. A master of deception, he was also a brilliant forger, whose skill gave him his first real claim to fame: At the age of 17, Frank Abagnale, Jr. became the most successful bank robber in the history of the U.S. FBI Agent Carl Hanratty (Tom Hanks) makes it his prime mission to capture Frank and bring him to justice, but Frank is always one step ahead of him.', 2002, 'PG-13'),
(18, 'Baby Driver', '10.00', 'baby_driver.jpg', 6, 'Baby, a music-loving orphan also happens to be the prodigiously talented go-to getaway driver for heist mastermind Doc. With the perfect soundtrack picked out for each and every job, Baby ensures Doc\'s violent, bank-robbing cronies - including Buddy, Bats and Darling - get in and out of Dodge before it\'s too late. He\'s not in it for the long haul though, hoping to nail one last job before riding off into the sunset with beautiful diner waitress Debora. Easier said than done.', 2017, 'R'),
(19, 'Marathon Man', '-1.00', 'marathon_man.jpg', 6, 'Thomas \"Babe\" Levy (Dustin Hoffman) is a Columbia graduate student and long-distance runner who is oblivious to the fact that his older brother, Doc (Roy Scheider), is a government agent chasing down a Nazi war criminal (Laurence Olivier) -- that is, until Doc is murdered and Babe finds himself knee-deep in a tangle of stolen gems and sadistic madmen. Even his girlfriend, Elsa (Marthe Keller), becomes a suspect as everything Babe believed to be true is suddenly turned upside down.', 1976, 'R'),
(20, 'Promising Young Woman', '-1.00', 'promising_young_woman.jpg', 6, 'Nothing in Cassie\'s life is what it appears to be -- she\'s wickedly smart, tantalizingly cunning, and she\'s living a secret double life by night. Now, an unexpected encounter is about to give Cassie a chance to right the wrongs from the past.', 2020, 'R'),
(21, 'Jurassic Park', '-1.00', 'jurassic_park.jpg', 5, 'In Steven Spielberg\'s massive blockbuster, paleontologists Alan Grant (Sam Neill) and Ellie Sattler (Laura Dern) and mathematician Ian Malcolm (Jeff Goldblum) are among a select group chosen to tour an island theme park populated by dinosaurs created from prehistoric DNA. While the park\'s mastermind, billionaire John Hammond (Richard Attenborough), assures everyone that the facility is safe, they find out otherwise when various ferocious predators break free and go on the hunt.', 1993, 'PG-13'),
(22, 'Scott Pilgrim vs. the World', '8.00', 'scott_pilgrim.jpg', 1, 'As bass guitarist for a garage-rock band, Scott Pilgrim (Michael Cera) has never had trouble getting a girlfriend; usually, the problem is getting rid of them. But when Ramona Flowers (Mary Elizabeth Winstead) skates into his heart, he finds she has the most troublesome baggage of all: an army of ex-boyfriends who will stop at nothing to eliminate him from her list of suitors.', 2010, 'PG-13'),
(23, 'Mrs. Doubtfire', '-1.00', 'doubtfire.jpg', 7, 'Troubled that he has little access to his children, divorced Daniel Hillard (Robin Williams) hatches an elaborate plan. With help from his creative brother Frank (Harvey Fierstein), he dresses as an older British woman and convinces his ex-wife, Miranda (Sally Field), to hire him as a nanny. \"Mrs. Doubtfire\" wins over the children and helps Daniel become a better parent -- but when both Daniel and his nanny persona must meet different parties at the same restaurant, his secrets may be exposed.', 1993, 'PG-13'),
(24, 'Back to the Future', '-1.00', 'back_to_the_future.jpg', 5, 'In this 1980s sci-fi classic, small-town California teen Marty McFly (Michael J. Fox) is thrown back into the \'50s when an experiment by his eccentric scientist friend Doc Brown (Christopher Lloyd) goes awry. Traveling through time in a modified DeLorean car, Marty encounters young versions of his parents (Crispin Glover, Lea Thompson), and must make sure that they fall in love or he\'ll cease to exist. Even more dauntingly, Marty has to return to his own time and save the life of Doc Brown.', 1985, 'PG'),
(25, 'Harry Potter and the Sorceror\'s Stone', '-1.00', 'harry_potter1.jpg', 4, 'Adaptation of the first of J.K. Rowling\'s popular children\'s novels about Harry Potter, a boy who learns on his eleventh birthday that he is the orphaned son of two powerful wizards and possesses unique magical powers of his own. He is summoned from his life as an unwanted child to become a student at Hogwarts, an English boarding school for wizards. There, he meets several friends who become his closest allies and help him discover the truth about his parents\' mysterious deaths.', 2001, 'PG'),
(26, 'Nobody', '9.00', 'nobody.jpg', 1, 'Hutch Mansell fails to defend himself or his family when two thieves break into his suburban home one night. The aftermath of the incident soon strikes a match to his long-simmering rage. In a barrage of fists, gunfire and squealing tires, Hutch must now save his wife and son from a dangerous adversary -- and ensure that he will never be underestimated again.', 2021, 'R'),
(27, 'Hot Rod', '-1.00', 'hot_rod.jpg', 2, 'For Rod Kimball (Andy Samberg), performing stunts is a way of life, even though he is rather accident-prone. Poor Rod cannot even get any respect from his stepfather, Frank (Ian McShane), who beats him up in weekly sparring matches. When Frank falls ill, Rod devises his most outrageous stunt yet to raise money for Frank\'s operation -- and then Rod will kick Frank\'s butt.', 2007, 'PG-13'),
(28, '30 Minutes or Less', '7.00', 'minutes_or_less.jpg', 2, 'Nick (Jesse Eisenberg) is a pizza deliverer who lives a fairly ordinary, boring life -- until he crosses paths with two aspiring criminal masterminds (Danny McBride, Nick Swardson), who kidnap him, strap a bomb to his chest and force him to rob a bank for them. Nick doesn\'t get much time to pull off the difficult task, so he enlists the aid of Chet (Aziz Ansari), his estranged pal. As time ticks away, Nick and Chet face many obstacles, not the least of which is their volatile relationship.', 2011, 'R'),
(29, 'Happy Gilmore', '-1.00', 'happy_gilmore.jpg', 2, 'All Happy Gilmore (Adam Sandler) has ever wanted is to be a professional hockey player. But he soon discovers he may actually have a talent for playing an entirely different sport: golf. When his grandmother (Frances Bay) learns she is about to lose her home, Happy joins a golf tournament to try and win enough money to buy it for her. With his powerful driving skills and foulmouthed attitude, Happy becomes an unlikely golf hero -- much to the chagrin of the well-mannered golf professionals.', 1996, 'PG-13'),
(30, 'The Social Network', '9.00', 'social_network.jpg', 3, 'In 2003, Harvard undergrad and computer genius Mark Zuckerberg (Jesse Eisenberg) begins work on a new concept that eventually turns into the global social network known as Facebook. Six years later, he is one of the youngest billionaires ever, but Zuckerberg finds that his unprecedented success leads to both personal and legal complications when he ends up on the receiving end of two lawsuits, one involving his former friend (Andrew Garfield).', 2010, 'PG-13'),
(31, 'School of Rock', '-1.00', 'school_of_rock.jpg', 2, 'Overly enthusiastic guitarist Dewey Finn (Jack Black) gets thrown out of his band and finds himself in desperate need of work. Posing as a substitute music teacher at an elite private elementary school, he exposes his students to the hard rock gods he idolizes and emulates -- much to the consternation of the uptight principal (Joan Cusack). As he gets his privileged and precocious charges in touch with their inner rock \'n\' roll animals, he imagines redemption at a local Battle of the Bands.', 2003, 'PG-13'),
(32, 'Nacho Libre', '7.00', 'nacho_libre.jpg', 2, 'Ignacio (Jack Black), or Nacho to his friends, works as a cook in the Mexican monastery where he grew up. The monastery is home to a host of orphans whom Nacho cares for deeply, but there is not much money to feed them properly. Nacho decides to raise money for the children by moonlighting as a Lucha Libre wrestler with his partner Esqueleto (Héctor Jiménez), but since the church forbids Lucha, Nacho must disguise his identity.', 2006, 'PG'),
(33, 'Halloween', '-1.00', 'halloween.jpg', 6, 'On a cold Halloween night in 1963, six year old Michael Myers killed his 17-year-old sister, Judith. He was sentenced and locked away for 15 years. But on October 30, 1978, while being transferred for a court date, a 21-year-old Michael Myers steals a car and escapes Smith\'s Grove. He returns to his quiet hometown of Haddonfield, Illinois, where he looks for his next victims..', 1978, 'R'),
(34, 'Shang-Chi', '-1.00', 'shang_chi.jpg', 1, 'A skilled marial artist who was trained at a young age to be an assaassin by his father Wenwu, Shang-Chi (Simu Liu) must confront the past he thought he left behind when he is drawn into the web of the mysterious Ten Rings organization.', 2021, 'PG-13'),
(35, 'Iron Man', '-1.00', 'ironman.jpg', 1, 'A billionaire industrialist and genius inventor, Tony Stark (Robert Downey Jr.), is conducting weapons tests overseas, but terrorists kidnap him to force him to build a devastating weapon. Instead, he builds an armored suit and upends his captors. Returning to America, Stark refines the suit and uses it to combat crime and terrorism.', 2008, 'PG-13'),
(36, 'Legally Blonde', '-1.00', 'legally_blonde.jpg', 2, 'Elle Woods (Reese Witherspoon) has it all. She wants nothing more than to be Mrs. Warner Huntington III. But there is one thing stopping him (Matthew Davis) from proposing: She is too blond. Elle rallies all of her resources and gets into Harvard, determined to win him back.', 2001, 'PG-13'),
(37, 'Doctor Strange', '-1.00', 'dr_strange.jpg', 1, 'Dr. Stephen Strange\'s (Benedict Cumberbatch) life changes after a car accident robs him of the use of his hands. When traditional medicine fails him, he looks for healing, and hope, in a mysterious enclave. He quickly learns that the enclave is at the front line of a battle against unseen dark forces bent on destroying reality. Before long, Strange is forced to choose between his life of fortune and status or leave it all behind to defend the world as the most powerful sorcerer in existence.', 2016, 'PG-13'),
(38, 'Furious 7', '-1.00', 'furious7.jpg', 1, 'After defeating international terrorist Owen Shaw, Dominic Toretto (Vin Diesel), Brian O\'Conner (Paul Walker) and the rest of the crew have separated to return to normal lives. However, Deckard Shaw (Jason Statham), Owen\'s older brother, is thirsty for revenge. A slick government agent offers to help Dom and company take care of Shaw in exchange for their help in rescuing a kidnapped computer hacker who has developed a powerful surveillance program.', 2015, 'PG-13'),
(39, 'Kingsmen: The Golden Circle', '-1.00', 'kingsmen2.jpg', 1, 'With their headquarters destroyed and the world held hostage, members of Kingsman find new allies when they discover a spy organization in the United States known as Statesman. In an adventure that tests their strength and wits, the elite secret agents from both sides of the pond band together to battle a ruthless enemy and save the day, something that\'s becoming a bit of a habit for Eggsy.', 2017, 'PG-13'),
(40, 'Dune', '-1.00', 'dune.jpg', 5, 'Paul Atreides, a brilliant and gifted young man born into a great destiny beyond his understanding, must travel to the most dangerous planet in the universe to ensure the future of his family and his people. As malevolent forces explode into conflict over the planet\'s exclusive supply of the most precious resource in existence, only those who can conquer their own fear will survive.', 2021, 'PG-13'),
(41, 'Get Out', '-1.00', 'get_out.jpg', 6, 'Now that Chris and his girlfriend, Rose, have reached the meet-the-parents milestone of dating, she invites him for a weekend getaway with Missy and Dean. At first, Chris reads the family\'s overly accommodating behavior as nervous attempts to deal with their daughter\'s interracial relationship, but as the weekend progresses, a series of increasingly disturbing discoveries leads him to a truth that he never could have imagined.', 2017, 'R'),
(42, 'John Wick', '-1.00', 'john_wick.jpg', 1, 'Legendary assassin John Wick (Keanu Reeves) retired from his violent career after marrying the love of his life. Her sudden death leaves John in deep mourning. When sadistic mobster Iosef Tarasov (Alfie Allen) and his thugs steal John\'s prized car and kill the puppy that was a last gift from his wife, John unleashes the remorseless killing machine within and seeks vengeance. Meanwhile, Iosef\'s father (Michael Nyqvist) puts a huge bounty on John\'s head.', 2014, 'R'),
(43, 'Thor', '-1.00', 'thor_2011.jpg', 1, 'The warrior Thor (Chris Hemsworth) is cast out of the fantastic realm of Asgard by his father Odin (Sir Anthony Hopkins) for his arrogance and sent to Earth to live amongst humans. Falling in love with scientist Jane Foster (Natalie Portman) teaches Thor much-needed lessons, and his new-found strength comes into play as a villain from his homeland sends dark forces toward Earth.', 2011, 'PG-13'),
(44, 'Captain America: The First Avenger', '8.00', 'CaptainAmerica.jpg', 1, 'It is 1942, America has entered World War II, and sickly but determined Steve Rogers is frustrated at being rejected yet again for military service. Everything changes when Dr. Erskine recruits him for the secret Project Rebirth. Proving his extraordinary courage, wits and conscience, Rogers undergoes the experiment and his weak body is suddenly enhanced into the maximum human potential. When Dr. Erskine is then assassinated by an agent of Germany\'s secret HYDRA research department, Rogers is left as a unique man who is initially misused as a propaganda mascot. However, when his comrades need him, Rogers goes on a successful adventure that truly makes him Captain America.', 2011, 'PG-13'),
(45, 'Free Guy', '-1.00', 'FreeGuy.jpg', 2, 'When a bank teller discovers he\'s actually a background player in an open-world video game, he decides to become the hero of his own story -- one that he can rewrite himself. In a world where there\'s no limits, he\'s determined to save the day his way before it\'s too late, and maybe find a little romance with the coder who conceived him.', 2021, 'PG-13'),
(46, 'Venom', '-1.00', 'venom.jpg', 1, 'Journalist Eddie Brock is trying to take down Carlton Drake, the notorious and brilliant founder of the Life Foundation. While investigating one of Drake\'s experiments, Eddie\'s body merges with the alien Venom -- leaving him with superhuman strength and power. Twisted, dark and fueled by rage, Venom tries to control the new and dangerous abilities that Eddie finds so intoxicating.', 2018, 'PG-13'),
(47, 'Interstellar', '-1.00', 'Interstellar.jpg', 5, 'Earth\'s future has been riddled by disasters, famines, and droughts. There is only one way to ensure mankind\'s survival: Interstellar travel. A newly discovered wormhole in the far reaches of our solar system allows a team of astronauts to go where no man has gone before, a planet that may have the right environment to sustain human life.', 2014, 'PG-13'),
(48, '1917', '-1.00', '1917.jpg', 3, 'During World War I, two British soldiers -- Lance Cpl. Schofield and Lance Cpl. Blake -- receive seemingly impossible orders. In a race against time, they must cross over into enemy territory to deliver a message that could potentially save 1,600 of their fellow comrades -- including Blake\'s own brother.', 2019, 'R'),
(49, 'The Imitation Game', '-1.00', 'imitation_game.jpg', 3, 'In 1939, newly created British intelligence agency MI6 recruits Cambridge mathematics alumnus Alan Turing (Benedict Cumberbatch) to crack Nazi codes, including Enigma -- which cryptanalysts had thought unbreakable. Turing\'s team, including Joan Clarke (Keira Knightley), analyze Enigma messages while he builds a machine to decipher them. Turing and team finally succeed and become heroes, but in 1952, the quiet genius encounters disgrace when authorities reveal he is gay and send him to prison.', 2014, 'PG-13'),
(50, 'The Green Knight', '-1.00', 'green_knight.jpg', 4, 'Sir Gawain (Dev Patel), King Arthur\'s reckless and headstrong nephew, embarks on a daring quest to confront the eponymous Green Knight, a gigantic emerald-skinned stranger and tester of men. Gawain contends with ghosts, giants, thieves, and schemers in what becomes a deeper journey to define his character and prove his worth in the eyes of his family and kingdom by facing the ultimate challenger. From visionary filmmaker David Lowery comes a fresh and bold spin on a classic tale from the knights of the round table.', 2021, 'R'),
(51, 'The Hobbit: An Unexpected Journey', '-1.00', 'hobbit.jpg', 4, 'Bilbo Baggins (Martin Freeman) lives a simple life with his fellow hobbits in the shire, until the wizard Gandalf (Ian McKellen) arrives and convinces him to join a group of dwarves on a quest to reclaim the kingdom of Erebor. The journey takes Bilbo on a path through treacherous lands swarming with orcs, goblins and other dangers, not the least of which is an encounter with Gollum (Andy Serkis) and a simple gold ring that is tied to the fate of Middle Earth in ways Bilbo cannot even fathom.', 2012, 'PG-13'),
(52, 'Night at the Museum', '-1.00', 'night_at_museum.jpg', 7, 'Dreamer Larry Daley thinks he\'s destined for something big but his imaginative ideas never pay off and in desperate need of a job, he accepts to be a security guard at the Natural History Museum. During his watch, Larry makes a startling discovery. Thanks to the unleashing of an Egyptian curse, the museum\'s animals spring to life after the building closes. Larry must find a way to save the chaotic situation.', 2006, 'PG'),
(53, 'Shrek', '8.50', 'shrek.jpg', 4, 'Once upon a time, in a far away swamp, there lived an ogre named Shrek (Mike Myers) whose precious solitude is suddenly shattered by an invasion of annoying fairy tale characters. They were all banished from their kingdom by the evil Lord Farquaad (John Lithgow). Determined to save their home -- not to mention his -- Shrek cuts a deal with Farquaad and sets out to rescue Princess Fiona (Cameron Diaz) to be Farquaad\'s bride. Rescuing the Princess may be small compared to her deep, dark secret.', 2001, 'PG'),
(54, 'Jumanji', '-1.00', 'jumanji.jpg', 4, 'A magical board game unleashes a world of adventure on siblings Peter (Bradley Pierce) and Judy Shepherd (Kirsten Dunst). While exploring an old mansion, the youngsters find a curious, jungle-themed game called Jumanji in the attic. When they start playing, they free Alan Parrish (Robin Williams), who\'s been stuck in the game\'s inner world for decades. If they win Jumanji, the kids can free Alan for good -- but that means braving giant bugs, ill-mannered monkeys and even stampeding rhinos!', 1995, 'PG'),
(55, 'Inside Out', '-1.00', 'inside_out.jpg', 7, 'Riley (Kaitlyn Dias) is a happy, hockey-loving 11-year-old Midwestern girl, but her world turns upside-down when she and her parents move to San Francisco. Riley\'s emotions -- led by Joy (Amy Poehler) -- try to guide her through this difficult, life-changing event. However, the stress of the move brings Sadness (Phyllis Smith) to the forefront. When Joy and Sadness are inadvertently swept into the far reaches of Riley\'s mind, the only emotions left in Headquarters are Anger, Fear and Disgust.', 2015, 'PG'),
(56, 'Up', '-1.00', 'up.jpg', 7, 'Carl Fredricksen, a 78-year-old balloon salesman, is about to fulfill a lifelong dream. Tying thousands of balloons to his house, he flies away to the South American wilderness. But curmudgeonly Carl\'s worst nightmare comes true when he discovers a little boy named Russell is a stowaway aboard the balloon-powered house. A Pixar animation.', 2009, 'PG'),
(57, 'It\'s a Wonderful Life', '-1.00', 'wonderful_life.jpg', 3, 'George Bailey has so many problems he is thinking about ending it all - and it\'s Christmas! As the angels discuss George, we see his life in flashback. As George is about to jump from a bridge, he ends up rescuing his guardian angel, Clarence - who then shows George what his town would have looked like if it hadn\'t been for all his good deeds over the years.', 1946, 'PG'),
(58, 'Spirited Away', '-1.00', 'spirited_away.jpg', 4, 'In this animated feature by noted Japanese director Hayao Miyazaki, 10-year-old Chihiro (Rumi Hiiragi) and her parents (Takashi Naitô, Yasuko Sawaguchi) stumble upon a seemingly abandoned amusement park. After her mother and father are turned into giant pigs, Chihiro meets the mysterious Haku (Miyu Irino), who explains that the park is a resort for supernatural beings who need a break from their time spent in the earthly realm, and that she must work there to free herself and her parents.', 2001, 'PG'),
(59, 'The Pianist', '-1.00', 'Pianist.jpg', 3, 'Wladyslaw Szpilman (Adrien Brody), a Polish Jewish radio station pianist, sees Warsaw change gradually as World War II begins. Szpilman is forced into the Warsaw Ghetto, but is later separated from his family during Operation Reinhard. From this time until the concentration camp prisoners are released, Szpilman hides in various locations among the ruins of Warsaw.', 2002, 'R'),
(60, 'Casablanca', '-1.00', 'casablanca.jpg', 3, 'Rick Blaine (Humphrey Bogart), who owns a nightclub in Casablanca, discovers his old flame Ilsa (Ingrid Bergman) is in town with her husband, Victor Laszlo (Paul Henreid). Laszlo is a famed rebel, and with Germans on his tail, Ilsa knows Rick can help them get out of the country.', 1942, 'PG'),
(61, 'Princess Mononoke', '-1.00', 'Princess_mononoke.jpg', 4, 'In the 14th century, the harmony that humans, animals and gods have enjoyed begins to crumble. The protagonist, young Ashitaka - infected by an animal attack, seeks a cure from the deer-like god Shishigami. In his travels, he sees humans ravaging the earth, bringing down the wrath of wolf god Moro and his human companion Princess Mononoke. Hiskattempts to broker peace between her and the humans brings only conflict.', 1997, 'PG-13'),
(62, 'Once Upon a Time in America', '-1.00', 'In_america.jpg', 3, 'In 1968, the elderly David \"Noodles\" Aaronson (Robert De Niro) returns to New York, where he had a career in the criminal underground in the \'20s and \'30s. Most of his old friends, like longtime partner Max (James Woods), are long gone, yet he feels his past is unresolved. Told in flashbacks, the film follows Noodles from a tough kid in a Jewish slum in New York\'s Lower East Side, through his rise to bootlegger and then Mafia boss -- a journey marked by violence, betrayal and remorse.', 1984, 'R'),
(63, 'Memento', '-1.00', 'Memento.jpg', 6, 'Leonard (Guy Pearce) is tracking down the man who murdered his wife. The difficulty, however, of locating his wife\'s killer is compounded by the fact that he suffers from a rare, untreatable form of memory loss. Although he can recall details of life before his accident, Leonard cannot remember what happened fifteen minutes ago, where he\'s going, or why.', 2000, 'R'),
(64, 'Capernaum', '-1.00', 'capernaum.jpg', 3, 'Capernaum follows Zain, a gutsy streetwise child, as he flees his negligent parents, survives through his wits on the streets, takes care of Ethiopian refugee Rahil (Yordanos Shiferaw) and her baby son, Yonas (Boluwatife Treasure Bankole), is jailed for a crime, and finally, seeks justice in a courtroom.', 2018, 'R'),
(65, 'The Great Dictator', '-1.00', 'The_Great_Dictator.jpg', 2, 'After dedicated service in the Great War, a Jewish barber (Charles Chaplin) spends years in an army hospital recovering from his wounds, unaware of the simultaneous rise of fascist dictator Adenoid Hynkel (also Chaplin) and his anti-Semitic policies. When the barber, who bears a remarkable resemblance to Hynkel, returns to his quiet neighborhood, he is stunned by the brutal changes and recklessly joins a beautiful girl (Paulette Goddard) and her neighbors in rebelling.', 1940, 'G'),
(66, 'Star Wars: Episode V - The Empire Strikes Back', '9.00', 'star_wars5.jpg', 5, 'The adventure continues in this Star Wars sequel. Luke Skywalker (Mark Hamill), Han Solo (Harrison Ford), Princess Leia (Carrie Fisher) and Chewbacca (Peter Mayhew) face attack by the Imperial forces and its AT-AT walkers on the ice planet Hoth. While Han and Leia escape in the Millennium Falcon, Luke travels to Dagobah in search of Yoda. Only with the Jedi master\'s help will Luke survive when the dark side of the Force beckons him into the ultimate duel with Darth Vader (David Prowse).', 1980, 'PG'),
(67, 'Star Wars: Episode VI - Return of the Jedi', '10.00', 'star_wars6.jpg', 5, 'Luke Skywalker (Mark Hamill) battles horrible Jabba the Hut and cruel Darth Vader to save his comrades in the Rebel Alliance and triumph over the Galactic Empire. Han Solo (Harrison Ford) and Princess Leia (Carrie Fisher) reaffirm their love and team with Chewbacca, Lando Calrissian (Billy Dee Williams), the Ewoks and the androids C-3PO and R2-D2 to aid in the disruption of the Dark Side and the defeat of the evil emperor.', 1983, 'PG'),
(68, 'Big', '8.00', 'big.jpg', 2, 'After a wish turns 12-year-old Josh Baskin (David Moscow) into a 30-year-old man (Tom Hanks), he heads to New York City and gets a low-level job at MacMillen Toy Company. A chance encounter with the owner (Robert Loggia) of the company leads to a promotion testing new toys. Soon a fellow employee, Susan Lawrence (Elizabeth Perkins), takes a romantic interest in Josh. However, the pressure of living as an adult begins to overwhelm him, and he longs to return to his simple, former life as a boy.', 1988, 'PG'),
(69, 'Liar Liar', '-1.00', 'liar.jpg', 2, 'Conniving attorney Fletcher Reede (Jim Carrey) is an ace in the courtroom, but his dishonesty and devotion to work ruin his relationships. His wife, Audrey (Maura Tierney), has left him for a more dependable man, and Fletcher often breaks the commitments he makes to his beloved son, Max (Justin Cooper). When Max wishes his dad would stop lying for 24 hours, Fletcher suddenly finds that he can only speak the truth on the day his career-deciding court case has to be won.', 1997, 'PG-13'),
(70, 'Cars', '-1.00', 'cars.jpg', 7, 'While traveling to California to race against The King (Richard Petty) and Chick Hicks (Michael Keaton) for the Piston Cup Championship, Lightning McQueen (Owen Wilson) becomes lost after falling out of his trailer in a run down town called Radiator Springs. While there he slowly befriends the town\'s odd residents, including Sally (Bonnie Hunt), Doc Hudson (Paul Newman) and Mater (Larry the Cable Guy). When it comes time for him to leave to championship is no longer his top priority.', 2006, 'G');

-- --------------------------------------------------------

--
-- Table structure for table `queueItem`
--

CREATE TABLE `queueItem` (
  `queueItemId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `movieId` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queueItem`
--

INSERT INTO `queueItem` (`queueItemId`, `userId`, `movieId`, `date`) VALUES
(23, 30, 22, '12/01/2021'),
(26, 27, 9, '12/03/2021'),
(27, 27, 2, '12/03/2021'),
(28, 27, 46, '12/03/2021'),
(29, 26, 21, '12/03/2021'),
(34, 39, 6, '12/03/2021'),
(37, 28, 28, '12/03/2021'),
(38, 28, 19, '12/03/2021'),
(41, 1, 26, '12/04/2021'),
(49, 30, 62, '12/05/2021'),
(50, 30, 31, '12/05/2021'),
(52, 1, 69, '12/05/2021'),
(53, 1, 18, '12/05/2021'),
(62, 42, 3, '12/06/2021'),
(63, 42, 32, '12/06/2021'),
(67, 42, 26, '12/12/2021'),
(68, 1, 14, '12/12/2021'),
(71, 44, 8, '12/12/2021'),
(72, 44, 12, '12/12/2021');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `reviewId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `movieId` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `comment` text NOT NULL,
  `timeStamp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`reviewId`, `userId`, `movieId`, `score`, `comment`, `timeStamp`) VALUES
(36, 26, 3, 8, 'This is a pretty impressive film. I think that it perfectly balances the action with Peter\'s emotional conflict. It is my favorite out of the original trilogy.', '01:56pm on 11/20/2021'),
(37, 27, 3, 5, 'It\'s a superhero movie just like any other, so if you like action, you\'ll like this movie. But if you\'re looking for something more than a run of the mill Marvel movie, look elsewhere.', '11:50am on 11/20/2021'),
(38, 28, 3, 10, 'The perfect sequel! It doesn\'t surprise me that even in 2004 Marvel was already the king. How could anyone not love Toby Maguire as Spider Man? And that train scene has to be one of the coolest movie scenes of all time!', '11:55am on 11/20/2021'),
(39, 30, 3, 9, 'This movie is amazing. I loved it when I was younger and I love it even more now. I really love how relatable it is to me, and how I deal with some of the same problems Peter deals with. I also love Alfred Molina as Doc Ock, he not only plays a great villain that you have sympathy for, but he also does an amazing job at it. Of course, I can\'t ignore Tobey Maguire as Spider-Man, who nails every aspect of the character. Overall, There\'s so much I love about this movie, like the humor and action and story.', '03:56pm on 11/24/2021'),
(42, 27, 1, 10, 'Has there ever been a better final scene of a movie?  I don\'t think so, the X-Wing attack on the Death Star remains to this day the greatest cinematic experience of all time!  Let\'s not forget the rest of the film, beginning with the opening scene of the Empire chasing down a rebellion ship with a perfect camera shot and of course the introduction of all the characters from the dark, dam right imposing figure of Darth Vader, the elegant and fiery Princess Leia, the eager to learn Luke Skywalker to the charm and charisma of Solo. Lastly, honorable mentions to the special effects (for its time), costume designs (especially Stormtroopers!) and John Williams musical score. Star Wars quite simply is the standard benchmark for all other comparable epic movies and the aptly named \"A New Hope\" not only represents the title of the movie but also a beginning of a Sci-Fi movie era!!!', '04:23pm on 12/12/2021'),
(45, 1, 68, 8, 'Even thought the genie freaked me out as a kid, I think this is a great movie to watch with the whole family about growing up.', '09:11pm on 11/27/2021'),
(49, 1, 3, 7, 'I\'m not a huge Marvel fan, but I still liked this movie. In my opinion this is the best incarnation of spider man. Even if you\'re not big on \"superhero\" movies, I bet you can still find a lot of enjoyment out of this one.', '02:53pm on 12/08/2021'),
(51, 1, 15, 9, 'It was utterly ridiculous but had so many quotable lines and likable characters. Although still funny, it does feel a bit slow to start with but I\'m unsure if that has anything to do with the extended version I watched or not... but it certainly picks up the pace as the film moves forward.  The film encompasses many styles of humour that is tailored to play to the strengths of each actor and because of that, it\'s arguably the best Will Ferrell film. That\'s nothing against his later classics such Step Brothers or Talladega Nights, but they didn\'t feel as smartly written as Anchorman. There are a couple jokes you probably won\'t get away with in this day and age but I think that\'s part of the enjoyment of re-watching it!', '02:31pm on 12/06/2021'),
(53, 1, 28, 7, 'Danny McBride plays a great incompetent bad guy, but this movie didn\'t feel like anything too special. Great cast, but just another mid-2000s comedy.', '03:11pm on 12/08/2021'),
(55, 1, 53, 9, 'A classic in both the world of animation and in computer animation. This is arguably the sleeper film that showed that a studio outside of Disney could do a great fully computer animated film. All the main characters are memorable, the way they used familiar fairy tale characters is funny and clever/unique, the story goes completely against what you\'d expect (which is what they\'re going for), and the soundtrack perfectly fits the mood or is used for quick punches of fun.', '01:14pm on 12/02/2021'),
(57, 27, 53, 8, 'What a revolutionary film for computer graphics. The fairytale world setting being turned on its head is such a great concept. The sequel is better in my opinion though.', '06:10pm on 12/03/2021'),
(59, 26, 9, 9, 'Masterful visual storytelling on an epic scale.It is hard to imagine a better tribute to this victory of survival than Christopher Nolan\'s spare, stunning, extraordinarily ambitious film.', '06:16pm on 12/03/2021'),
(60, 39, 2, 10, 'The best movie ever, it\'s a GREAT movie! Marlon Brando gives a great performance as Don Vito Corleone, so does Al Pacino and Robert Duvall, it is the best drama in history, it is a classic! I absolutely loved the story! ', '06:20pm on 12/03/2021'),
(61, 28, 2, 9, 'Well, Godfather is one of the cinematic classics and it\'s really difficult to pinpoint one thing which would make it a big success that it is. The whole cast is amazing and they defined the \'Mafia\' genre with their acting skills.', '06:24pm on 12/03/2021'),
(62, 28, 8, 9, 'This was probably the biggest film event I\'ll ever see in my lifetime. What a send off to this incarnation of the Marvel cinematic universe.', '06:28pm on 12/03/2021'),
(65, 28, 44, 8, 'Captain America: The First Avenger may be far from perfect, don\'t get me wrong. It\'s not Sam Raimi\'s Spider-Man, nor is it even as good as the sequels ironically, but it IS a very good origin story.', '11:34pm on 12/04/2021'),
(67, 30, 67, 10, 'This is the best Star Wars movie!!!! There is not one thing about it that I do not like.', '03:21pm on 12/05/2021'),
(68, 30, 66, 9, 'This movie was even better than the first one! It further develops the characters and pushes the Star Wars Universe in a new and darker direction.', '03:22pm on 12/05/2021'),
(71, 30, 15, 6, 'Some of the jokes didn\'t really land for me. I didn\'t like the 70\'s centric humor.', '03:29pm on 12/05/2021'),
(73, 28, 1, 9, 'Amazing movie. My second favorite Star Wars film, A New Hope is a nostalgic, powerful, and iconic movie. It creates some of the most memorable heroes and villains in all of movie history. The movie is genius and an imaginative story that inspired children of the 70s and 80s.', '03:41pm on 12/05/2021'),
(75, 1, 22, 9, 'Edgar Wright really shined as the director of this movie. It was so stylized that every scene felt like it was torn straight from a comic book.', '03:46pm on 12/05/2021'),
(83, 30, 1, 10, 'A perfect start to one of film\'s most successful movie franchises. I will never forget the sense of wonder I had when watching this movie for the first time. George Lucas is a genius.', '11:20pm on 12/05/2021'),
(85, 39, 1, 8, 'The characters are fun and interesting to watch, the special effects are astounding for its time, and it sets up whole character arcs that play out not just for the two films to follow, but for the rest of the saga as seen in all other Star Wars media.', '11:22pm on 12/05/2021'),
(86, 26, 1, 8, 'I\'ve never been a huge fan of star wars, but you have to respect what a landmark that this film is.', '11:24pm on 12/05/2021'),
(88, 27, 22, 7, 'This didn\'t seem much more to me than just another comic book movie, but I\'ll give it some points for the music and for being funny.', '11:27pm on 12/05/2021'),
(89, 27, 15, 9, 'One of Will Ferrell\'s iconic and memorable performances. Not to mention the first time many of us were introduced to the laugh riot known as Steve Carell.', '11:27pm on 12/05/2021'),
(92, 42, 30, 9, 'This was a great depiction of the Mark Zuckerberg story. I was really engaged from start to end, which is rare for me.', '02:20pm on 12/06/2021'),
(94, 1, 1, 8, 'I\'m not really into science fiction, but I still have to admit that this film was great. So if you aren\'t a fan of science fiction, I bet you will still be able to enjoy this film.', '02:52pm on 12/08/2021'),
(95, 26, 32, 7, 'If you\'re looking for a goofy comedy, this movie is for you. It would be a good movie to watch with your kids. Jack Black got a lot of loud laughs out of me. But there isn\'t really anything of substance story-wise.', '03:00pm on 12/08/2021'),
(101, 42, 14, 5, 'Even though it was the best they could work with at the time, I think the animation for this movie aged very poorly.', '02:57pm on 12/12/2021'),
(103, 39, 14, 7, 'I think the sequels are definitely better, but this was a good first step. The dynamic between Woody and Buzz is written very well.', '03:04pm on 12/12/2021'),
(107, 44, 18, 10, 'The soundtrack for this movie absolutely pushed it over the top for me. This movie is perfectly stylized and has a heart-pounding finish.', '04:07pm on 12/12/2021'),
(109, 44, 14, 7, 'I think I\'m in the general consensus when I say that this movie was fine, but the other Disney Pixar movies that came later blew this one away.', '04:11pm on 12/12/2021'),
(110, 44, 26, 9, 'Who would have thought that Bob Odenkirk could be an action star! I\'m looking forward to what other surprising leading roles he takes next.', '04:14pm on 12/12/2021');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `favoriteGenreId` int(11) NOT NULL,
  `favoriteMovieId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `password`, `favoriteGenreId`, `favoriteMovieId`) VALUES
(1, 'DrewP', '123456', 2, 53),
(26, 'MovieMan02', 'user02', 3, 9),
(27, 'FilmBuff03', 'user03', 3, 49),
(28, 'MarvelLover04', 'user04', 1, 3),
(30, 'LukeSkywalker05', 'user05', 5, 1),
(39, 'Hairy_Dawg_06', 'user06', 6, 2),
(42, 'JohnDoe07', 'user07', 3, 30),
(44, 'MikeSmith08', 'user08', 1, 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genreId`);

--
-- Indexes for table `historyItem`
--
ALTER TABLE `historyItem`
  ADD PRIMARY KEY (`historyItemId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `movieId` (`movieId`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movieId`),
  ADD KEY `genreId` (`genreId`);

--
-- Indexes for table `queueItem`
--
ALTER TABLE `queueItem`
  ADD PRIMARY KEY (`queueItemId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `movieId` (`movieId`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `movieId` (`movieId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `favoriteGenreId` (`favoriteGenreId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genreId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `historyItem`
--
ALTER TABLE `historyItem`
  MODIFY `historyItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `movieId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `queueItem`
--
ALTER TABLE `queueItem`
  MODIFY `queueItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `reviewId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `historyItem`
--
ALTER TABLE `historyItem`
  ADD CONSTRAINT `historyitem_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `historyitem_ibfk_2` FOREIGN KEY (`movieId`) REFERENCES `movie` (`movieId`);

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`genreId`) REFERENCES `genre` (`genreId`);

--
-- Constraints for table `queueItem`
--
ALTER TABLE `queueItem`
  ADD CONSTRAINT `queueitem_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `queueitem_ibfk_2` FOREIGN KEY (`movieId`) REFERENCES `movie` (`movieId`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`movieId`) REFERENCES `movie` (`movieId`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`favoriteGenreId`) REFERENCES `genre` (`genreId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
