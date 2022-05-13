
--
-- Database: `ggsipuattendancedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

CREATE TABLE `logindetails` (
  `s.no` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `logindetails` (`s.no`, `mail`, `password`) VALUES
(1, 'nitin041@ipu.ac.in', 'Abcdef@12');

-- --------------------------------------------------------

--
-- Table structure for table `radiodata`
--

CREATE TABLE `radiodata` (
  `enrollNo` int(11) NOT NULL,
  `AbsentPresent` varchar(15) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `radiodata`
--

INSERT INTO `radiodata` (`enrollNo`, `AbsentPresent`, `date`) VALUES
(1, 'present', '2022-05-13'),
(2, 'present', '2022-05-13'),
(3, 'absent', '2022-05-13'),
(4, 'present', '2022-05-13'),
(5, 'present', '2022-05-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logindetails`
--
ALTER TABLE `logindetails`
  ADD PRIMARY KEY (`s.no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logindetails`
--
ALTER TABLE `logindetails`
  MODIFY `s.no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

