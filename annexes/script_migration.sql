CREATE TABLE Blogs (
  PRIMARY KEY (blog_id),
  blog_id      INTEGER NOT NULL AUTO_INCREMENT,
  blog_title   VARCHAR(255),
  blog_img     TEXT,
  blog_date    DATE,
  blog_content TEXT,
  user_id      INTEGER NOT NULL
);

CREATE TABLE Blog_Votes (
  PRIMARY KEY (blog_Vote_id),
  blog_Vote_id   INTEGER NOT NULL AUTO_INCREMENT,
  blog_Vote_date DATE,
  blog_Vote      INTEGER NOT NULL,
  user_id        INTEGER NOT NULL,
  blog_id        INTEGER NOT NULL
);

CREATE TABLE Categories (
  PRIMARY KEY (cat_id),
  cat_id          INTEGER NOT NULL AUTO_INCREMENT,
  cat_name        VARCHAR(255),
  cat_description TEXT
);

CREATE TABLE Conversation (
  PRIMARY KEY (conversation_id),
  conversation_id            INTEGER NOT NULL AUTO_INCREMENT,
  conservation_date_creation DATE
);

CREATE TABLE Discute (
  PRIMARY KEY (user_id, conversation_id),
  user_id         INTEGER NOT NULL,
  conversation_id INTEGER NOT NULL
);

CREATE TABLE Events (
  PRIMARY KEY (event_id),
  event_id           INTEGER NOT NULL AUTO_INCREMENT,
  event_title        VARCHAR(255),
  event_date_created DATE,
  event_date         DATE,
  event_img        TEXT,
  event_headline     VARCHAR(255),
  event_description  TEXT,
  user_id            INTEGER NOT NULL
);

CREATE TABLE Messages (
  PRIMARY KEY (message_id),
  message_id      INTEGER NOT NULL AUTO_INCREMENT,
  message_content TEXT,
  message_date    datetime,
  conversation_id INTEGER NOT NULL,
  user_id INTEGER NOT NULL
);

CREATE TABLE Polls (
  PRIMARY KEY (poll_id),
  poll_id           INTEGER NOT NULL AUTO_INCREMENT,
  poll_subject      VARCHAR(255),
  poll_created      DATETIME,
  poll_modified     DATETIME,
  poll_status       BOOLEAN,
  poll_description  TEXT,
  poll_locked       BOOLEAN,
  user_id           INTEGER NOT NULL
);

CREATE TABLE Poll_Options (
  PRIMARY KEY (poll_Option_id),
  poll_Option_id     INTEGER NOT NULL AUTO_INCREMENT,
  poll_Option_name   VARCHAR(255),
  poll_Option_status BOOLEAN,
  poll_id            INTEGER NOT NULL
);

CREATE TABLE Poll_Votes (
  PRIMARY KEY (poll_Vote_id),
  poll_Vote_id   INTEGER NOT NULL AUTO_INCREMENT,
  user_id        INTEGER NOT NULL,
  poll_Option_id INTEGER NOT NULL
);

CREATE TABLE Posts (
  PRIMARY KEY (post_id),
  post_id      INTEGER NOT NULL AUTO_INCREMENT,
  post_content TEXT,
  post_date    DATE,
  topic_id     INTEGER NOT NULL,
  user_id      INTEGER NOT NULL
);

CREATE TABLE Post_Votes (
  PRIMARY KEY (post_Vote_id),
  post_Vote_id   INTEGER NOT NULL AUTO_INCREMENT,
  post_Vote_date DATE,
  post_Vote      INTEGER,
  post_id        INTEGER NOT NULL,
  user_id        INTEGER NOT NULL
);

CREATE TABLE Pwd_Reset (
  PRIMARY KEY (reset_id),
  reset_id       INTEGER NOT NULL AUTO_INCREMENT,
  reset_email    VARCHAR(255),
  reset_selector TEXT,
  reset_token    TEXT,
  reset_expires  TEXT
);

CREATE TABLE Topics (
  PRIMARY KEY (topic_id),
  topic_id      INTEGER NOT NULL AUTO_INCREMENT,
  topic_subject TEXT,
  topic_date    DATE,
  cat_id        INTEGER,
  user_id       INTEGER
);

CREATE TABLE Users (
  PRIMARY KEY (user_id),
  user_id            INTEGER NOT NULL AUTO_INCREMENT,
  user_level         INTEGER,
  user_first_name    VARCHAR(255),
  user_last_name     VARCHAR(255),
  username           VARCHAR(255),
  user_email         VARCHAR(255),
  user_password_hash TEXT,
  user_gender        CHAR(1),
  user_headline      VARCHAR(255),
  user_bio           TEXT,
  user_img           TEXT
);

ALTER TABLE Blogs ADD FOREIGN KEY (user_id) REFERENCES Users (user_id) ON DELETE CASCADE;

ALTER TABLE Blog_Votes ADD FOREIGN KEY (blog_id) REFERENCES Blogs (blog_id) ON DELETE CASCADE;
ALTER TABLE Blog_Votes ADD FOREIGN KEY (user_id) REFERENCES Users (user_id) ON DELETE CASCADE;

ALTER TABLE Discute ADD FOREIGN KEY (conversation_id) REFERENCES Conversation (conversation_id) ON DELETE CASCADE;
ALTER TABLE Discute ADD FOREIGN KEY (user_id) REFERENCES Users (user_id) ON DELETE CASCADE;

ALTER TABLE Events ADD FOREIGN KEY (user_id) REFERENCES Users (user_id) ON DELETE CASCADE;

ALTER TABLE Messages ADD FOREIGN KEY (conversation_id) REFERENCES Conversation (conversation_id) ON DELETE CASCADE;
ALTER TABLE Messages ADD FOREIGN KEY (user_id) REFERENCES Users (user_id) ON DELETE CASCADE;


ALTER TABLE Polls ADD FOREIGN KEY (user_id) REFERENCES Users (user_id) ON DELETE CASCADE;

ALTER TABLE Poll_Options ADD FOREIGN KEY (poll_id) REFERENCES Polls (poll_id) ON DELETE CASCADE;

ALTER TABLE Poll_Votes ADD FOREIGN KEY (poll_Option_id) REFERENCES Poll_Options (poll_Option_id) ON DELETE CASCADE;
ALTER TABLE Poll_Votes ADD FOREIGN KEY (user_id) REFERENCES Users (user_id) ON DELETE CASCADE;

ALTER TABLE Posts ADD FOREIGN KEY (user_id) REFERENCES Users (user_id) ON DELETE CASCADE; 
ALTER TABLE Posts ADD FOREIGN KEY (topic_id) REFERENCES Topics (topic_id);

ALTER TABLE Post_Votes ADD FOREIGN KEY (user_id) REFERENCES Users (user_id) ON DELETE CASCADE;
ALTER TABLE Post_Votes ADD FOREIGN KEY (post_id) REFERENCES Posts (post_id) ON DELETE CASCADE;

ALTER TABLE Topics ADD FOREIGN KEY (user_id) REFERENCES Users (user_id) ON DELETE SET NULL;
ALTER TABLE Topics ADD FOREIGN KEY (cat_id) REFERENCES Categories (cat_id) ON DELETE SET NULL;


INSERT INTO `Users` (`user_id`, `user_level`, `user_first_name`, `user_last_name`, `username`, `user_email`, `user_password_hash`, `user_gender`, `user_headline`, `user_bio`, `user_img`) VALUES
(0, 1, 'Crazy', 'Programmer', 'saad', 'muhammadsaad.crytek@gmail.com', '$2y$10$NlmqH7ELe9VUFwLqWuFcv.2Js/8jJ36Jga3KWYvXFuaaQN4CzaEtO', 'm', 'CEO of Google and Tesla (Elon is my wife)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '5c2268b62fa342.98640611.jpg'),
(0, 0, '', '', 'sadcat', 'a@a.a', '$2y$10$RiiU91TqjjVhPdVpypQBtuq0etClplrZ3HNTLPFrUheJ.sy7ZifwK', 'f', '', '', '5bf28f767563d4.32287587.jpg'),
(0, 0, '', '', 'crazyblogger', 'aaa@gmail.com', '$2y$10$zXwVteLyKxjwSMDk.a8/HeoYzmfFInzvftURiCyt27z03mgbdkSNy', 'm', '', '', '5c2097e915f3e7.13501262.jpg'),
(0, 0, '', '', 'vegetapoopoo', 'asd@asd.asd', '$2y$10$S4X2HZUWyQXV7zLwirj2dOBVEbDHFDhsX6y91asglNa6QBnlq9ik.', 'f', '', '', '5bf2ebf077fb14.69408796.gif'),
(0, 0, '', '', 'yhamster', 'anas.tasadduq@gmail.com', '$2y$10$j5scT2dgJuZGBBYBFRsKVe.n50dLCjdYvcpY1Vy1.jES8f6ojulAi', 'm', '', '', '5c03ad0de59709.45156405.jpg'),
(0, 0, '', '', 'Owais', 'owaisrehman110@gmail.com', '$2y$10$EM.p1ed./gfrenQRn5Je1etujHptdTebKy8fgDU0de1wGqQvOOCcK', 'm', '', '', 'default.png'),
(0, 0, '', '', 'constipated', 'was@was.was', '$2y$10$BnAjjEdfYa0koUab7jB2wuK/Hw5PEoRHMsIjuPOgFDK3umLLPnE2a', 'm', '', '                                Tell people about yourself\r\n                            ', '5c2099a0e98e21.69993944.jpg'),
(0, 0, 'burhan', 'ahmed', 'progamer', 'qq@qq.qq', '$2y$10$9RwEOoQi4i7BHcVuN9sihOQ156yAqPOi1/cGayAc83glZMUJ8B702', 'f', 'what to do with myself', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '5c1b521a779e33.90465765.jpg'),
(0, 0, 'soSaad', 'Seriously', 'sad', 'sad@sad.sad', '$2y$10$MgXJs2KXFHDywcokNF.Ya.FubCPFkCV5WhvpzyDw7KioB.hImzjpS', 'm', '', '', '5c1e837c23fbd4.49025477.jpg'),
(0, 0, 'aass', 'aass', 'designer', 'sss@sss.sss', '$2y$10$a/DczAbcWogc9E.QVtQ27uaIaQKIY.qi.d7OSyOI/XHT.g.DCF0XG', 'f', 'hallo hallo', 'pls go die, seriously', '5c20049a28f083.62453939.jpg'),
(0, 0, 'Anas', 'Tasadduq', 'aitasadduq', 'atasadduq.bese17seecs@seecs.edu.pk', '$2y$10$mE..r1B9evnZeZ03CRmChO6hOCzWyzSOiciIjvYynq4atCtWBZtfy', 'm', 'I\'m great!', 'I don\'t really want to tell much about myself...', '5c207f31c827d2.61541321.jpg'),
(0, 0, 'Ubaid', 'Asim', 'UbaidAsim', 'ubaidasim514@gmail.com', '$2y$10$mJY/nezYA6PXFy0t.xXMyuVQOAdLi5I/ag.SWwUVFvHkZGcfqwd3S', 'm', 'Freelance Graphics and Brand Designer, Social Media Strategist', 'Software Engineering Student at SEECS, NUST', '5c207f7341e066.29286370.jpg'),
(0, 0, 'Syed', 'Kamal', 'syedanaskamal', 'syedanaskamal@gmail.com', '$2y$10$.fUUvM3BoaCPV9Blp8CobONwQpI1r6kSUnts.QTm3a9Yovo5le.N6', 'm', 'wassup', 'no', 'default.png'),
(0, 0, '', '', 'testuser', 'testuser@test.com', '$2y$10$80YI6fiwFyOLHhn4CIOG/.xSAmkvG1L12LHGXjlNMdjwxeQCx/GNy', 'm', '', '', '5c20b68db30f81.29224418.jpg'),
(0, 0, '', '', 'marium', 'ms.merium.fatima@gmail.com', '$2y$10$l0AOTRif1CfL7pONxdOxHuyg4worYd4yagtUcom9u/LPeQs6n4ZN2', 'f', '', '', 'default.png');

INSERT INTO `Categories` (`cat_id`, `cat_name`, `cat_description`) VALUES
(0, 'finance sciences', 'all topics related to finance and economy like making double decker chocolate cake and how to end the world in 3 days'),
(0, 'gardening', 'different gardening techniques used to torture helpless victims and make them dream of attending horrible opera performances'),
(0, 'Technical Difficulties', 'Issues and debates related to immediate actions which must be taken on event of a serious butthurt');

INSERT INTO `blogs` (`blog_id`, `blog_title`, `blog_img`, `user_id`, `blog_date`, `blog_content`) VALUES
(0, 'First Blog', 'default.png', 1, '2018-12-09', 'Random Content'),
(0, 'Another Blog', 'default.png', 1, '2018-12-09', 'This blog also contains some random content but in more quantity.'),
(0, 'Third Blog', 'default.png', 1, '2018-12-09', 'Sorry for boring you with random stuff.'),
(0, 'Fourth Blog', 'default.png', 1, '2018-12-09', 'blah blah blah'),
(0, 'Hey There!', 'default.png', 7, '2018-12-09', 'Seriously, you wasted time by visiting this blog.'),
(0, 'aaaaaa', 'default.png', 1, '2018-12-19', 'aaaaaaa'),
(0, 'qqqqq', 'default.png', 1, '2018-12-19', 'dddddddddd'),
(0, 'saad', 'default.png', 1, '2018-12-19', 'saadsaad'),
(0, 'ss', '5c1a4cbaf0e603.76106810.jpg', 1, '2018-12-19', 'sss'),
(0, 'Random Bullshit', '5c1aa8a0080a30.59734693.jpg', 1, '2018-12-20', 'Online Bookstore is an online web application which makes buying books easy and efficient. People can buy books online through this application and get them delivered to their doorstep. The application is developed for two kinds of users: customers and administrators. The basic idea is to make the application user friendly and to give users several features in the application. For example, customers can register to the site using their first name, last name, valid email ID, shipping address, contact number and credit card details. Once they’re registered on the site, they can view the list of available books and search for them according to their genre, authors, rating, release year etc. They can purchase books one by one through their credit cards or manage their own bucket list on site. They can add the books they’re interested in to the bucket list. Once done, it shows them the total price and they can order them all together. The app also provides administrative features to the administrators like creating, editing, viewing and deleting a book. All these book related actions are managed through a controller. Another model handles all the logic and data related to items in the shop. The application also provides a series of interactive and visually appealing Graphical User Interface (GUI) to the users.\r\n\r\nNowadays, the network plays an import role in people’s life. In the process of the improvement of the people’s living standard, people’s demands of the life’s quality and efficiency is more higher, the traditional bookstore’s inconvenience gradually emerge, and the online bookstore has gradually be used in public. The online bookstore is a revolution of book industry. The traditional bookstores’ operation time, address and space is limited, so the types of books and books to find received a degree of restriction. But the online bookstore broke the management mode of traditional bookstore, as long as you have a computer, you can buy the book anywhere, saving time and effort, shortening the time of book selection link effectively. The online bookstore system based on the principle of provides convenience and service to people. Thus the online book store allows user to add the books in a bucket list and later that bucket list can be edited.'),
(0, 'damn im thirsty', 'blog-cover.png', 1, '2018-12-23', 'gimme some of that milk boii'),
(0, 'Kill him?', '5c20807b0024e5.50196869.jpg', 12, '2018-12-24', 'Your votes wont make a difference. He\'s gonna die anyway'),
(0, 'Staying Healthy', 'blog-cover.png', 11, '2018-12-24', 'Eight healthy behaviors can go a long way toward improving your health and lowering your risk of many cancers as well as heart disease, stroke, diabetes, and osteoporosis. And they’re not as complicated as you might think.\r\n\r\nSo take control of your health, and encourage your family to do the same. Choose one or two of the behaviors below to start with. Once you’ve got those down, move on to the others.\r\n\r\n1. Maintain a Healthy Weight\r\nKeeping your weight in check is often easier said than done, but a few simple tips can help. First off, if you’re overweight, focus initially on not gaining any more weight. This by itself can improve your health. Then, when you’re ready, try to take off some extra pounds for an even greater health boost. To see where you fall on the weight range, click here.\r\n\r\nTips\r\nIntegrate physical activity and movement into your life.\r\nEat a diet rich in fruits, vegetables and whole grains.\r\nChoose smaller portions and eat more slowly.\r\nFor Parents and Grandparents \r\nLimit children’s TV and computer time.\r\nEncourage healthy snacking on fruits and vegetables.\r\nEncourage activity during free time.\r\n2. Exercise Regularly\r\nFew things are as good for you as regular physical activity. While it can be hard to find the time, it’s important to fit in at least 30 minutes of activity every day. More is even better, but any amount is better than none.\r\n\r\nTips \r\nChoose activities you enjoy. Many things count as exercise, including walking, gardening and dancing.\r\nMake exercise a habit by setting aside the same time for it each day. Try going to the gym at lunchtime or taking a walk regularly after dinner.\r\nStay motivated by exercising with someone.\r\nFor Parents and Grandparents \r\nPlay active games with your kids regularly and go on family walks and bike rides when the weather allows.\r\nEncourage children to play outside (when it’s safe) and to take part in organized activities, including soccer, gymnastics and dancing.\r\nWalk with your kids to school in the morning. It’s great exercise for everyone.\r\n3. Don’t Smoke\r\nYou’ve heard it before: If you smoke, quitting is absolutely the best thing you can do for your health. Yes, it’s hard, but it’s also far from impossible. More than 1,000 Americans stop for good every day.\r\n\r\nTips \r\nKeep trying! It often takes six or seven tries before you quit for good.\r\nTalk to a health-care provider for help.\r\nJoin a quit-smoking program. Your workplace or health plan may offer one.\r\nFor Parents and Grandparents\r\nTry to quit as soon as possible. If you smoke, your children will be more likely to smoke.\r\nDon’t smoke in the house or car. If kids breathe in your smoke, they may have a higher risk of breathing problems and lung cancer.\r\nWhen appropriate, talk to your kids about the dangers of smoking and chewing tobacco. A health-care professional or school counselor can help.\r\n4. Eat a Healthy Diet\r\nDespite confusing news reports, the basics of healthy eating are actually quite straightforward. You should focus on fruits, vegetables and whole grains and keep red meat to a minimum. It’s also important to cut back on bad fats (saturated and trans fats) and choose healthy fats (polyunsaturated and monounsaturated fats) more often. Taking a multivitamin with folate every day is a great nutrition insurance policy.\r\n\r\nTips\r\nMake fruits and vegetables a part of every meal. Put fruit on your cereal. Eat vegetables as a snack.\r\nChoose chicken, fish or beans instead of red meat.\r\nChoose whole-grain cereal, brown rice and whole-wheat bread over their more refined counterparts.\r\nChoose dishes made with olive or canola oil, which are high in healthy fats.\r\nCut back on fast food and store-bought snacks (like cookies), which are high in bad fats.\r\nBuy a 100 percent RDA multivitamin that contains folate.\r\n5. Drink Alcohol Only in Moderation, If at All\r\nModerate drinking is good for the heart, as many people already know, but it can also increase the risk of cancer. If you don’t drink, don’t feel that you need to start. If you already drink moderately (less than one drink a day for women, less than two drinks a day for men), there’s probably no reason to stop. People who drink more, though, should cut back.\r\n\r\nTips\r\nChoose nonalcoholic beverages at meals and parties.\r\nAvoid occasions centered around alcohol.\r\nTalk to a health-care professional if you feel you have a problem with alcohol.\r\nFor Parents and Grandparents\r\nAvoid making alcohol an essential part of family gatherings.\r\nWhen appropriate, discuss the dangers of drug and alcohol abuse with children. A health-care professional or school counselor can help.\r\n6. Protect Yourself from the Sun\r\nWhile the warm sun is certainly inviting, too much exposure to it can lead to skin cancer, including serious melanoma. Skin damage starts early in childhood, so it’s especially important to protect children.\r\n\r\nTips\r\nSteer clear of direct sunlight between 10 a.m. and 4 p.m. (peak burning hours). It’s the best way to protect yourself.\r\nWear hats, long-sleeve shirts and sunscreens with SPF15 or higher.\r\nDon’t use sun lamps or tanning booths. Try self-tanning creams instead.\r\nFor Parents and Grandparents \r\nBuy tinted sunscreen so you can see if you’ve missed any spots on a fidgety child.\r\nSet a good example for children by also protecting yourself with clothing, shade and sunscreen.\r\n7. Protect Yourself From Sexually Transmitted Infections\r\nAmong other problems, sexually transmitted infections – like human papillomavirus (HPV) – are linked to a number of different cancers. Protecting yourself from these infections can lower your risk.\r\n\r\nTips\r\nAside from not having sex, the best protection is to be in a committed, monogamous relationship with someone who does not have a sexually transmitted infection.\r\nFor all other situations, be sure to always use a condom and follow other safe-sex practices.\r\nNever rely on your partner to have a condom. Always be prepared.\r\nFor Parents and Grandparents\r\nWhen appropriate, discuss with children the importance of abstinence and safe sex. A health-care professional or school counselor can help.\r\nVaccinate girls and young women as well as boys and young men against HPV. Talk to a health professional for more information.\r\n8. Get Screening Tests\r\nThere are a number of important screening tests that can help protect against cancer. Some of these tests find cancer early when they are most treatable, while others can actually help keep cancer from developing in the first place. For colorectal cancer alone, regular screening could save over 30,000 lives each year. That’s three times the number of people killed by drunk drivers in the United States in all of 2011. Talk to a health care professional about which tests you should have and when.\r\n\r\nCancers that should be tested for regularly:\r\nColon and rectal cancer\r\nBreast cancer\r\nCervical cancer\r\nLung cancer (in current or past heavy smokers)'),
(0, 'SpaceX Wraps Up 2018 With First National Security Launch for U.S. Government', '5c2081b2ed5a23.91620400.jpg', 12, '2018-12-24', 'Elon Musk’s SpaceX launched its first national security payload for the U.S. government (specifically the Air Force) on Sunday, delivering a roughly $500 million GPS satellite constructed by Lockheed Martin into orbit on a Falcon 9 rocket from Cape Canaveral at 8:51 a.m. ET, the Guardian reported.\r\n\r\nThe launch itself was delayed several times over the past week—including once when the Falcon 9 rocket’s first stage displayed unexpected sensor readings and twice for inclement weather, according to Space.com. The Verge wrote the launch managed to avoid further delay due to the ongoing government showdown because funding for the Department of Defense has already been allocated for 2019.\r\n\r\nThe GPS III satellite SpaceX launched on Sunday (Vespucci) is a next-generation version that will eventually help offer significantly more accurate geolocation services, though as the Verge wrote, the Air Force is still working on the ground-based systems necessary to operate it:\r\n\r\nThe GPS III satellite will also feature a stronger transmitter as part of efforts to prevent signal jamming\r\n\r\nThe Falcon 9 in question’s first stage did not re-attempt landing, as the payload was too heavy and delivered too high into orbit for the rocket to meet performance requirements in its reusable configuration.\r\n\r\n“There simply was not a performance reserve to meet our requirements and allow for this mission to bring the first stage back,” Walter Lauderdale, mission director at the Air Force’s Space and Missile Systems Center (SMC) Launch Enterprise Systems Directorate, told reporters earlier this month, according to Space.com. However, he added that future GPS III missions may feature attempts to recover the first stage, depending on flight results from Sunday’s mission.'),
(0, 'Report: Wall Street Is Getting Cold Feet on Bitcoin as Crypto Crash Continues', '5c2082ccc677a5.85542680.jpg', 12, '2018-12-24', 'The crypto crash has continued, with about $700 billion wiped off the market since its peak at around $800 billion at the start of the year, and leaving a trail of destroyed startups behind it. Bitcoin at one point closed in on the $3,000 price mark, well below both its peak of nearly $20,000 in 2017 and a so-called “floor” of $6,000. And now major Wall Street firms once rumored to be preparing entries to the cryptocurrency market—particularly bitcoin futures—appear to have gotten cold feet after a brutal beatdown in crypto prices this year, Bloomberg reported on Sunday.\r\n\r\nA bevy of major firms including Goldman Sachs, Morgan Stanley, Citigroup, and Barclays (of London) have all delayed plans to launch bitcoin-related financial services, Bloomberg wrote. Goldman, which “was among the first on Wall Street to clear Bitcoin futures,” was reportedly preparing a trading desk, and offers “derivatives on Bitcoin called non-deliverable forwards” (NDF), has yet to offer crypto trading and has seen little interest in the NDF product:\r\n\r\nThe bank has yet to offer trading of crypto and has gained little traction for its NDF product, having signing up just 20 clients, according to people familiar with the matter. Justin Schmidt, who was hired to head its digital-asset business, said at an industry conference last month that regulators are limiting what he can do. Still, Goldman plans to add a digital-assets specialist to its prime brokerage division, the person said\r\n\r\nSources told Bloomberg that Morgan Stanley “has been technically prepared to offer swaps tracking Bitcoin futures since at least September,” but yet to trade a single contract. Citigroup has not traded any of its cryptocurrency products “within existing regulatory structures, according to a separate person with knowledge of its business,” the site added, instead only conducting trades by proxy. Barclays lost two executives hired to explore the industry and told Bloomberg it has no plans to launch a crypto trading desk.\r\n\r\nMuch of the caution has been due to the crash, but other factors have included a lack of guidance from regulators and a bevy of criminal and other investigations in the sector, according to Bloomberg’s report.\r\n\r\nAs Bloomberg noted, true believers in cryptocurrency remain stalwart that the big financial institutions are still building the infrastructure to get into the market (which could rescue the plummeting prices of major coins like bitcoin). Some industry sites have portrayed the crash as an opportunity to clear out scammers and reduce price volatility. Bloomberg wrote:\r\n\r\nEven after the staggering sell-off in digital assets in 2018—a year after Bitcoin came in touching distance of $20,000 it now trades at around $4,000—crypto pros see signs institutions are getting ready to jump back in if they need to.\r\n\r\n“The more important story is all the infrastructure that’s being built now to enable institutional trading,” according to Ben Sebley, a former Credit Suisse Group AG trader who is now head of brokerage at crypto boutique NKB Group.\r\n\r\nEven after the plunge that erased $700 billion from the value of crypto assets, believers are sticking to their script... “It appears as if progress is coming to a halt, yet nothing could be further from the truth,” said Eugene Ng, a former Deutsche Bank AG trader in Singapore who has set up crypto hedge fund Circuit Capital.\r\n\r\nMoreover, Nasdaq and the New York Stock Exchange were both eyeing to move forward with futures projects in 2019 as of late November, per CNBC, though two that already existed—run by the Chicago Board Options Exchange and the Chicago Mercantile Exchange—had already reached “their lowest level since they were introduced in December.”\r\n\r\nBut earlier this month, Bloomberg separately reported the outlook isn’t much better.\r\n\r\n“Based on the GTI VERA Band Indicator, Bitcoin is below its lower band indicating more potential losses to come and no current floor,” the site wrote, with more losses likely to come.\r\n\r\n[Bloomberg]'),
(0, 'Flying Hotel', '5c208422acd2c8.18059325.jpg', 11, '2018-12-24', 'Outline\r\nMessage claims that attached photographs show a unique flying luxury hotel called the “Hotelicopter” that is soon to begin its first tours.  \r\n\r\nBrief Analysis\r\nThe message was a 2009 April Fool’s joke created as a marketing campaign for a hotel search engine. Almost a decade on, versions of the hoax continue to cirulate.\r\n\r\nThe Hotelicopter features 18 luxuriously-appointed rooms for adrenaline junkies seeking a truly unique and memorable travel experience.\r\n\r\nEach soundproofed room is equipped with a queen-sized bed, fine linens, a mini-bar, coffee machine, wireless internet access, and all the luxurious appointments you’d expect from a flying five star hotel. Room service is available one hour after liftoff and prior to landing.” The Hotelicopter is due to fly maiden journey this summer(June 26th) with an undisclosed price…\r\n\r\nIf you are interested,There is three fly tour.\r\n\r\nInaugural Summer Tour – 14 days (Friday, June 26th, 2009 – Friday, July 10th, 2009)\r\n\r\nCalifornia Tour – 14 days (Friday, July 17th, 2009 to Friday, July 24rd, 2009)\r\nBay/Jamaica, European Tour – 16 days (Friday, July 31st, 2009 to Sunday, August 16th, 2009)\r\n\r\nDimensions Length: 42 m (137 ft)\r\nHeight: 28m (91 ft)\r\nMaximum Takeoff Weight: 105850 kg (232,870 lb)\r\nMaximum speed: 255 km/h (137 kt) (158 miles/h)\r\nCruising speed: 237 km/h (127 kt) (147 miles/h)\r\nOriginal Mi Range: 515 km (320 mi)\r\nOur augmented Mi Range – 1,296 km (700 mi)\r\n\r\n \r\n\r\nDetailed Analysis\r\nIn late March and early April 2009, stories about the “Hotelicopter” – a luxuriously appointed flying hotel – begin circulating via travel blogs and websites, social networking sites, and email. The stories included photographs of the Hotelicopter along with shots of rooms available for guests.\r\n\r\nA video of the Hotelicopter in action was also posted to YouTube. Supposedly, the Hotelicopter’s maiden voyage was scheduled for June 2009 with other “tours” to follow. \r\n\r\n\r\n\r\n\r\nAccording to the stories, the Hotelicopter is modelled on an old Soviet Mil V-12 helicopter and features 18 luxuriously-appointed soundproof rooms complete with queen-sized beds, wireless Internet and room service.\r\n\r\nHowever, the “Hotelicopter” was, in fact, an April Fools Day prank launched by a hotel search engine company. In a clever marketing ploy, the company used the prank as a promotional tool for a now-defunct hotel search engine website, hotelicopter.com. An article about the prank on m-Travel.com noted:\r\n\r\nA company, after being in news for its “flying-hotel joke”, has launched a new brand for its hotel search engine, hotelicopter.\r\n\r\n \r\n\r\nhotelicopter, which was previously known as VibeAgent, searches 30 travel sites in real-time, aggregating hotel room rates, availability, photos and video to instantly reveal where to find the best hotel deals. It has access to more than 65 travel partners and 150,000 hotels.\r\n\r\nHotelicopter.com owned up to the prank on its site blog:\r\n\r\nOh, and yes, we’re the folks behind the flying hotel of the same name. We were just having some fun, and had no idea it was going to blow up like it did – we’ve gotten about 1.5 million page and video views just in the last week – so thank you very much for all the attention and support – and hopefully we made you smile\r\n\r\nThe photographs of the supposed cabin interiors on the Hotelicopter were in fact taken from the Yotel website, apparently with Yotel’s full compliance and knowledge. Yotel offers tiny but very well appointed hotel rooms inside airports.\r\n\r\nAlmost a decade on, versions of the message continue to circulate and many recipients continue to believe its claims.\r\n\r\nFor the record, only two Mil V-12 helicopters were ever built. The first prototype was destroyed in a crash in 1969. The one remaining Mil V-12 is now displayed at the Monino air force museum in Moscow.'),
(0, 'The Impact of Fiction in our Evolution', 'blog-cover.png', 13, '2018-12-24', '\r\nScientific data proves that people who read more fiction are more likely to be fast learners and have high adaptability to real-life situations. <br><br>\r\n\r\nCommunication, usage of tools, and various other actions that were believed to differentiate between humans and other living beings have since been proven to be universal actions that other beings can learn. So what differentiates humans from other animals? Human\'s can simulate different situations in their mind and learn real-world skills from fictional worlds. <br><br>\r\n\r\nBut isn\'t fiction being lost as the art of reading books seems to decrease so much every year? This is merely a misconception as fiction is not being lost, but it is just transforming. Poetry transforms into musical lyrics, stories transform into games, which provide an even better simulation due to being fiction that changes based on stimulation. <br><br>\r\n\r\nThe importance of fiction can be seen just from how our brain works. We spend on average, 4 hours a day in daydreams, which are fictions that our mind creates that allow us to simulate different situations. This ability is something we have developed through evolution. <br><br>\r\n\r\nThe only downside is the fact that nowadays we can spend more time in our fictional world than needed. Similar to how in today\'s world we face health issues through overeating because of the abundance of food in most developed areas. <br><br>');

INSERT INTO `Blog_Votes` (`blog_Vote_id`, `blog_id`, `user_id`, `blog_Vote_date`, `blog_Vote`) VALUES
(0, 10, 1, '2018-12-21', 1),
(0, 11, 1, '2018-12-23', 1),
(0, 13, 11, '2018-12-24', 1),
(0, 15, 1, '2018-12-24', 1),
(0, 14, 1, '2018-12-24', 1),
(0, 14, 13, '2018-12-24', 1),
(0, 14, 11, '2018-12-24', 1),
(0, 3, 13, '2018-12-24', 1),
(0, 12, 12, '2018-12-24', 1),
(0, 17, 13, '2018-12-24', 1),
(0, 14, 12, '2018-12-24', 1),
(0, 14, 2, '2018-12-24', 1),
(0, 12, 1, '2018-12-26', 1),
(0, 17, 1, '2018-12-27', 1),
(0, 17, 15, '2018-12-28', 1);

INSERT INTO `conversation` (`conversation_id`, `conservation_date_creation`) VALUES 
(0, '2018-12-21'),
(0, '2018-12-22'),
(0, '2018-12-23'),
(0, '2018-12-24'),
(0, '2018-12-25'),
(0, '2018-12-26'),
(0, '2018-12-27'),
(0, '2018-12-28'),
(0, '2018-12-29'),
(0, '2018-12-30'),
(0, '2018-12-31'),
(0, '2019-01-01'),
(0, '2019-01-02'),
(0, '2019-01-03'),
(0, '2019-01-04'),
(0, '2019-01-05'),
(0, '2019-01-06');

INSERT INTO `Discute` (`user_id`, `conversation_id`) VALUES 
(1,1),
(6,1),
(1,2),
(2,2),
(2,3),
(6,3),
(1,4),
(3,4),
(2,5),
(4,5),
(1,6),
(5,6),
(1,7),
(7,7),
(13,8),
(1,8),
(13,9),
(11,9),
(12,10),
(1,10),
(13,11),
(3,11),
(3,12),
(2,12),
(11,13),
(1,13),
(14,14),
(12,14),
(14,15),
(11,15),
(1,16),
(14,16),
(15,17),
(11,17);

INSERT INTO `messages` (`message_id`, `conversation_id`, `user_id`, `message_content`, `message_date`) VALUES
(0, 1, 1, 'mmm', '2019-01-01 12:00:00'),
(0, 1, 3, 'hello', '2019-01-02 12:00:00'),
(0, 1, 1, 'aaa', '2019-01-03 12:00:00'),
(0, 1, 1, 'hello there', '2019-01-04 12:00:00'),
(0, 1, 1, 'a', '2019-01-05 12:00:00'),
(0, 2, 1, 'hey there buddy', '2019-01-06 12:00:00'),
(0, 2, 1, 'how ya doing?', '2019-01-07 12:00:00'),
(0, 2, 2, 'doing fine bro', '2019-01-08 12:00:00'),
(0, 2, 2, 'why havent you died yet', '2019-01-09 12:00:00'),
(0, 2, 1, 'dasd as das das das', '2019-01-10 12:00:00'),
(0, 2, 2, 'das das das', '2019-01-11 12:00:00'),
(0, 2, 1, 'fuck off', '2019-01-12 12:00:00'),
(0, 2, 2, 'you too ;}', '2019-01-13 12:00:00'),
(0, 2, 2, ':]', '2019-01-14 12:00:00'),
(0, 2, 1, 'dont be aa burden', '2019-01-15 12:00:00'),
(0, 2, 2, ':)', '2019-01-16 12:00:00'),
(0, 2, 2, 'no', '2019-01-17 12:00:00'),
(0, 2, 2, 'be your own burden', '2019-01-18 12:00:00'),
(0, 2, 1, 'yea i make my ownn burden', '2019-01-19 12:00:00'),
(0, 2, 2, 'being bese-8b be like', '2019-01-20 12:00:00'),
(0, 2, 1, 'aa', '2019-01-21 12:00:00'),
(0, 2, 2, 'Hey there!', '2019-01-22 12:00:00'),
(0, 2, 1, 'fuck off', '2019-01-23 12:00:00'),
(0, 2, 2, 'ok', '2019-01-24 12:00:00'),
(0, 2, 2, 'You told me to fuck off, so I\'m going now', '2019-01-25 12:00:00'),
(0, 2, 1, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2019-01-26 12:00:00'),
(0, 2, 2, 'aaaaaaaaaaaaaaaaaaaaaaaaaaa', '2019-01-27 12:00:00'),
(0, 2, 1, 'aaaaaaaaaaaaaaaaa', '2019-01-28 12:00:00'),
(0, 2, 2, 'aaaaaaaaaaaaaaaa', '2019-01-29 12:00:00'),
(0, 2, 2, 'hhhh', '2019-01-30 12:00:00'),
(0, 2, 2, 'f off raveed', '2019-01-31 12:00:00'),
(0, 2, 1, 'aaaaaaaaaaaaaaa', '2019-02-01 12:00:00'),
(0, 2, 1, 'a', '2019-02-02 12:00:00'),
(0, 2, 1, 'a', '2019-02-03 12:00:00'),
(0, 2, 1, 'a', '2019-02-04 12:00:00'),
(0, 2, 2, 'a', '2019-02-05 12:00:00'),
(0, 2, 2, 'a', '2019-02-06 12:00:00'),
(0, 2, 1, 'sasas', '2019-02-07 12:00:00'),
(0, 2, 1, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2019-02-08 12:00:00'),
(0, 2, 1, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2019-02-09 12:00:00'),
(0, 2, 1, 'dsadas dsa', '2019-02-10 12:00:00'),
(0, 2, 1, 'get lost', '2019-02-11 12:00:00'),
(0, 2, 1, 'sdasd dssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', '2019-02-12 12:00:00'),
(0, 2, 1, 'sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', '2019-02-13 12:00:00'),
(0, 2, 1, 'asdasdasd', '2019-02-14 12:00:00'),
(0, 2, 1, 'asdasdasd', '2019-02-15 12:00:00'),
(0, 2, 1, 'hey', '2019-02-16 12:00:00'),
(0, 8, 1, 'hello?', '2019-02-17 12:00:00'),
(0, 2, 1, 'oye', '2019-02-18 12:00:00'),
(0, 2, 1, 'hello', '2019-02-19 12:00:00'),
(0, 9, 4, 'wassup ma nigga', '2019-02-20 12:00:00'),
(0, 10, 4, 'fuck u', '2019-02-21 12:00:00'),
(0, 10, 4, 'fuck u', '2019-02-22 12:00:00'),
(0, 9, 1, 'fuck you', '2019-02-23 12:00:00'),
(0, 11, 5, 'soora', '2019-02-24 12:00:00'),
(0, 11, 1, 'dalla', '2019-02-25 12:00:00'),
(0, 10, 6, 'Please don\'t send offending messages', '2019-02-26 12:00:00'),
(0, 12, 6, 'Hi there!', '2019-02-27 12:00:00'),
(0, 12, 6, 'You ready for the presentation?', '2019-02-28 12:00:00'),
(0, 12, 1, 'hello', '2019-03-01 12:00:00'),
(0, 13, 7, 'hello', '2019-03-02 12:00:00'),
(0, 13, 6, 'heyyy', '2019-03-03 12:00:00'),
(0, 13, 6, 'heyyy', '2019-03-04 12:00:00'),
(0, 13, 6, 'heyyy', '2019-03-05 12:00:00'),
(0, 13, 6, 'heyyy', '2019-03-06 12:00:00'),
(0, 11, 1, 'oye', '2019-03-07 12:00:00'),
(0, 11, 1, 'i have something important to tell you', '2019-03-08 12:00:00'),
(0, 11, 1, 'i have something important to tell you', '2019-03-09 12:00:00'),
(0, 14, 1, 'hey', '2019-03-10 12:00:00'),
(0, 14, 1, 'hello?', '2019-03-11 12:00:00'),
(0, 13, 1, 'nah man, im too nervous', '2019-03-12 12:00:00');

INSERT INTO `Events` (`event_id`, `user_id`, `event_title`, `event_date_created`, `event_date`, `event_img`, `event_headline`, `event_description`) VALUES
(0, 1, 'annual suicide competition', '2018-12-23', '2019-01-01', 'event-cover.png', 'lezz go kill ourselves bois!', 'time to suicide!'),
(0, 1, 'Flat Earther Convention 2019', '2018-12-24', '2018-12-02', 'event-cover.png', 'They are deceiving us!! Open your eyes!','The flat Earth society encourages you to open your eyes to the realities of the world. what we we donot realize is that the government and Satan are lying to us that the earth is round. But we KNOW. deep down in our hearts, we KNOW that the earth is the shape of a velociraptor. And we WILL make the world believe it or burn'),
(0, 1, 'Food Gala', '2018-12-24', '2018-12-25', '5c209ba7d3f583.51289913.jpg', 'lets get FAT! like Anas Kamal', 'FOOD IS GOOD FOOD IS LIFE<br> I WANT FOOD I WANT SPICE'),
(0, 1, 'NUST massacre to cancel ESEs', '2018-12-24', '2018-12-26', '5c209c2766ac54.60298371.jpg', 'lets kill all the staff and cancel our papers', 'yay kill everyone like theres no tomorrow'),
(0, 1, 'Annual Welcome Party', '2018-12-24', '2019-01-01', 'event-cover.png', 'welcome to NUST where we all study and do nothing else (seriously)', 'welcome to nust everyone everyone now go study'),
(0, 1, 'Election Dharna', '2018-12-24', '2019-02-05', 'event-cover.png', 'HAMAREY SAATH DHAANDLI HUI HAI', 'Ye bik gai hai gormint,<br>\r\nye sarey ham ko pagal bana rahey hain'),
(0, 1, 'Student Council Election', '2018-12-24', '2018-12-28', '5c209d6e0abe93.18464278.jpg', 'Vote for the new council', 'pls vote :)');

INSERT INTO `Polls` (`poll_id`, `poll_subject`, `poll_created`, `poll_modified`, `poll_status`, `user_id`, `poll_description`, `poll_locked`) VALUES
(0, 'killing', '2018-12-04 20:27:26', '2018-12-04 20:27:26', '1', 1, '', 1),
(0, 'How to kill Linear Algebra', '2018-12-05 22:38:43', '2018-12-05 22:38:43', '1', 1, 'linear algebra has caused more deaths then eating pizza with pepsi in the last 69 years', 0),
(0, 'how to eat water', '2018-12-05 23:02:28', '2018-12-05 23:02:28', '1', 1, 'pls pls help me i dying of hunger i need a cigarette asap ', 1),
(0, 'what to buy on 9/11 festival', '2018-12-17 22:49:37', '2018-12-17 22:49:37', '1', 1, 'i want to celebrate 9/11 what do i buy to throw at people', 1);

INSERT INTO `Poll_Options` (`poll_Option_id`, `poll_id`, `poll_Option_name`, `poll_Option_status`) VALUES
(0, 1, 'gun', '1'),
(0, 1, 'opera', '1'),
(0, 1, 'poison', '1'),
(0, 1, 'algebra', '1'),
(0, 2, 'kill the teacher', '1'),
(0, 2, 'kill the creator', '1'),
(0, 2, 'kill everyone', '1'),
(0, 2, 'kill yourself', '1'),
(0, 2, 'how about a cup of tea?', '1'),
(0, 3, 'just eat it wtf', '1'),
(0, 3, 'go to hell', '1'),
(0, 4, 'a bomb', '1'),
(0, 4, 'my feelings', '1'),
(0, 4, 'a rock', '1'),
(0, 4, 'THE mount everest', '1'),
(0, 4, 'MY mount everest', '1');

INSERT INTO `Poll_Votes` (`poll_Vote_id`, `poll_Option_id`, `user_id`) VALUES
(0, 1, 1),
(0, 4, 2),
(0, 4, 4),
(0, 7, 4),
(0, 7, 2),
(0, 10, 1),
(0, 9, 1),
(0, 4, 12),
(0, 11, 13),
(0, 11, 11),
(0, 5, 14);

INSERT INTO `Topics` (`topic_id`, `topic_subject`, `topic_date`, `cat_id`, `user_id`) VALUES
(0, 'how to plant a nuclear bomb', '2018-11-18 11:13:00', 2, 1),
(0, 'how to kill myself', '2018-11-18 11:22:59', 2, 1),
(0, 'lol', '2018-11-21 16:04:52', 2, 2),
(0, 'how to drink tea', '2018-12-16 21:59:22', 3, 1),
(0, 'aa', '2018-12-17 22:44:48', 2, 1),
(0, 'Help in SQL', '2018-12-24 11:57:29', 3, 12),
(0, 'Debugging', '2018-12-24 12:04:30', 3, 11),
(0, 'Libraries', '2018-12-24 12:11:09', 3, 11);

INSERT INTO `Posts` (`post_id`, `post_content`, `post_date`, `topic_id`, `user_id`) VALUES
(0, 'qqqqq', '2018-11-19 16:03:59', 1, 3),
(0, 'qqqqq', '2018-11-19 16:05:30', 1, 3),
(0, 'go away', '2018-11-19 16:06:36', 1, 1),
(0, 'fuck off', '2018-11-19 16:07:03', 1, 2),
(0, 'yo wtf u niggas doing?\r\n', '2018-11-19 19:59:17', 1, 4),
(0, 'im bored tf am i supposed to do?', '2018-11-21 16:04:52', 3, 2),
(0, ' hj bjhb hj nj b j njn jjnsgjnfj ngjf ngjf ngjfn gdjf ngdjn gfdngjdn gjdfng djf gjdfn gjdjf gjd gjdf ngjdn fgjndjf gjdf ngjd fngjndfjg djf gjdf gjdfjgndjfnd gjdnfgjdfj gdjf gjdf gjdfjg dj gjd gjdjg jd gjdjg ndj gjdfn gjdnfj gndjf ngjd n', '2018-11-21 16:06:35', 1, 2),
(0, 'chup kar gashti', '2018-11-28 18:02:58', 1, 5),
(0, 'ami g ami g\r\n', '2018-11-30 14:19:52', 1, 5),
(0, 'a', '2018-12-01 21:06:57', 1, 4),
(0, 'hello people how are you all doing i hope ure doing well. if so, please kill yourself right now this is a matter of urgency we have to control the world population. this is a great cause and its an honor for all of u that u will die for such a great cause <br>', '2018-12-16 12:09:28', 1, 1),
(0, 'i have a serious butthurt somebody pls help ;_;', '2018-12-16 21:59:22', 4, 1),
(0, 'how would i know', '2018-12-17 22:03:29', 2, 1),
(0, 'aa', '2018-12-17 22:44:48', 5, 1),
(0, 'sdadadsadad', '2018-12-20 13:39:57', 1, 1),
(0, 'Im stuck at database project. Need help ! Cant create a schema in SQL.', '2018-12-24 11:57:29', 6, 12),
(0, 'Can anyone please tell me how to debug my C++ code?', '2018-12-24 12:04:30', 7, 11),
(0, 'G O O G L E it, ure welcome', '2018-12-24 12:06:16', 7, 1),
(0, 'Have you tried downloading some more RAM?', '2018-12-24 12:07:33', 7, 13),
(0, 'What do libraries do? Allow you to read books in your code? Or embed books in your code?', '2018-12-24 12:11:09', 8, 12),
(0, 'pls die', '2018-12-24 12:13:37', 8, 13),
(0, 'Pewdiepie >>>>> T-series', '2018-12-24 12:41:02', 8, 12),
(0, '\"It\'s okay if you\'re not made for coding\" - Sir Faisal Shafait', '2018-12-24 12:43:48', 7, 12),
(0, 'SUBSCRIBE TO T SERIES!!', '2018-12-24 12:58:21', 8, 1),
(0, 'hello', '2018-12-24 15:37:17', 8, 15),
(0, 'hey', '2018-12-25 22:26:12', 8, 1),
(0, 'we need to summon the magic cat to answer this question', '2018-12-27 18:01:51', 6, 1),
(0, 'hello', '2018-12-28 18:01:24', 8, 1),
(0, 'hey\r\n', '2018-12-31 19:54:09', 1, 1);


INSERT INTO `Post_Votes` (`post_Vote_id`, `post_id`, `user_id`, `post_Vote_date`, `post_Vote`) VALUES
(0, 7, 1, '2018-12-15', 1),
(0, 1, 1, '2018-12-17', 1),
(0, 11, 1, '2018-12-16', 1),
(0, 1, 2, '2018-12-16', -1),
(0, 11, 2, '2018-12-16', 1),
(0, 8, 2, '2018-12-16', 1),
(0, 12, 1, '2018-12-20', 1),
(0, 13, 13, '2018-12-24', 1),
(0, 18, 1, '2018-12-24', -1),
(0, 17, 13, '2018-12-24', -1),
(0, 18, 13, '2018-12-24', -1),
(0, 21, 13, '2018-12-24', -1),
(0, 22, 13, '2018-12-24', 1),
(0, 22, 11, '2018-12-24', 1),
(0, 20, 1, '2018-12-24', 1),
(0, 1, 12, '2018-12-24', 1),
(0, 23, 1, '2018-12-27', 1),
(0, 21, 12, '2018-12-24', -1),
(0, 23, 12, '2018-12-24', 1),
(0, 21, 14, '2018-12-24', 1),
(0, 21, 1, '2018-12-25', -1),
(0, 22, 1, '2018-12-25', 1),
(0, 26, 1, '2018-12-27', 1),
(0, 27, 1, '2018-12-27', 1),
(0, 25, 1, '2018-12-27', 1),
(0, 17, 1, '2018-12-27', -1),
(0, 29, 1, '2018-12-28', 1),
(0, 2, 1, '2018-12-31', 1),
(0, 3, 1, '2018-12-31', 1),
(0, 4, 1, '2018-12-31', 1),
(0, 9, 1, '2018-12-31', 1),
(0, 16, 1, '2018-12-31', 1);


INSERT INTO `Pwd_Reset` (`reset_id`, `reset_email`, `reset_selector`, `reset_token`, `reset_expires`) VALUES
(0, 'owaisrehman110@gmail.com', '73abf7a3e5e48bce', '$2y$10$9ytyvfXk8gb8gRzVfRglwevJBy6o46WDrp2ncNj58Y8sjWM4iNSTi', '1543912151'),
(0, '', '459ea1feb0d537ee', '$2y$10$jlC8JTnnikaZ7.4g4UMIHeIlqgJfe3iA4OFlruh5OQNtWVf1FfZqi', '1545078648'),
(0, 'asd@as.asd', 'fb72aeade725bc83', '$2y$10$HTEtmrlaWZpcspmoFAa90Owrd5V4UDorSyWapnRzGOjqxFkHKTexC', '1545079924'),
(0, 'a@a.a', '4c5a0e6dcd3aa696', '$2y$10$R6lxGNFwcrf0t3/onGFqseQNxzrYzsimBUU23k7XKUONE3rUZaTrm', '1545079978'),
(0, 'muhammadsaad.crytek@gmail.com', '34219d525a406a67', '$2y$10$TK.dVQ7B3Ulq95R.dCUdY.YLYAPOJBX8HDUiJW4CmEutkqg63BFQi', '1545915863'),
(0, 'pureliquid1999@gmail.com', '74e3d2f2db2cb3e3', '$2y$10$uB4kDEYHvlLk13irN3A/dOL7t6h.i6GKW8eXKZ3v2azUnlABXl.NW', '1545915911'),
(0, 'ms.merium.fatima@gmail.com', '62564c5e753b0ad3', '$2y$10$xBW5MsGZMevV8her23zBz.2qsJrWuLgtb.ThBiyUssPsy9tioShmi', '1546003625');
