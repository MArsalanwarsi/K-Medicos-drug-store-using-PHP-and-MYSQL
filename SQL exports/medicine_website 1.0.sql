-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2024 at 02:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicine_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_image`) VALUES
(1, 'Medicine', 'Category/medicine.jpeg'),
(2, 'Baby & Mother Care', 'Category/monther.jpeg'),
(3, 'Personal Care', 'Category/personal.jpeg'),
(4, 'OTC & Health Needs', 'Category/otc.jpeg'),
(5, 'Foods & Baverages', 'Category/foods.jpeg'),
(6, 'Nutrition & Supplements', 'Category/vitamin.jpeg'),
(7, 'Devices & Appliances', 'Category/devices.jpeg'),
(8, 'hygiene & Household', 'Category/hygene.jpeg'),
(9, 'Compounding', 'Category/compounding.jpeg'),
(10, 'lifestyle & Fitness', 'Category/fitness.jpeg'),
(11, 'Surgical', 'Category/surgical.jpeg'),
(12, 'Vaccines', 'Category/vaccines.png');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`) VALUES
(1, 'AGP (PRIVATE) LTD'),
(2, 'ABBOTT LABORATORIES (PAKISTAN) LIMITED'),
(3, 'CHIESI PHARMACEUTICALS (PVT) LTD'),
(4, 'GLAXOSMITHKLINE'),
(5, 'HILTON PHARMA (PVT) LIMITED'),
(6, 'GETZ PHARMA PAKISTAN (PVT) LTD'),
(7, 'GLOBAL PHARMACEUTICALS'),
(8, 'BOSCH PHARMACEUTICALS (PVT) LTD'),
(9, 'SWISS PHARMACEUTICALS (PVT) LTD'),
(10, 'TABROS PHARMA'),
(11, 'ATCO LABORATORIES'),
(12, 'NESTLE PAKISTAN LIMITED'),
(13, 'ZAFA PHARMACEUTICAL LABORATORIES (PVT) LTD'),
(14, 'SCILIFE PHARMA (PVT) LTD'),
(15, 'MARTIN DOW PHARMACEUTICALS (PAK) LTD'),
(16, 'NABIQASIM INDUSTRIES (PVT) LTD'),
(17, 'PHARMEVO (PVT) LTD'),
(18, 'MEDI FLOW PHARMACEUTICAL (PVT) LTD'),
(19, 'SANOFI AVENTIS (PAKISTAN) LTD'),
(20, 'PFIZER LABORATORIES LTD'),
(21, 'ASPIN PHARMA (PVT) LTD'),
(22, 'BARRETT HODGSON PAKISTAN'),
(23, 'MACTER INTERNATIONAL (PVT) LTD'),
(24, 'HIGHNOON LABORATORIES LTD'),
(25, 'HIG - Q INTERNATIONAL'),
(26, 'NOVARTIS PHARMA (PAK) LTD'),
(27, 'BAYER HEALTH CARE'),
(28, 'EFROZE CHEMICAL INDUSTRIES (PVT) LTD'),
(29, 'HIMONT CHEMICAL (PVT) LTD'),
(30, 'ICI PAKISTAN LTD'),
(31, 'EXCEL HEALTHCARE LABORATORIES (PVT) LTD'),
(32, 'WERRICK PHARMACEUTICALS'),
(33, 'OBS'),
(34, 'PHARMEDIC (PVT) LTD'),
(35, 'BROOKES PHARMACEUTICAL LABORATORIES (PAK). LTD');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL,
  `dosage` varchar(255) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `generic_name` varchar(255) NOT NULL,
  `strength` varchar(255) NOT NULL,
  `indication` varchar(255) NOT NULL,
  `adverce_drug_reaction` varchar(255) NOT NULL,
  `side_effect` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `counseling` varchar(255) NOT NULL,
  `pack_size` varchar(255) NOT NULL,
  `quatity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `prescription` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `dosage`, `brand_name`, `generic_name`, `strength`, `indication`, `adverce_drug_reaction`, `side_effect`, `category`, `company`, `counseling`, `pack_size`, `quatity`, `price`, `prescription`, `img`, `date`) VALUES
(1, 'Tablet', 'Atarax', 'hydroxyzine', '10mg', 'Anxiety, Insomnia, Urticaria', 'Hemolysis, Arrhythmias', 'Hypotension', 'Medicine', 'GLAXOSMITHKLINE', 'adminster at bed time', '50', 3, 34, 'Not Required', 'images/11152_1604x1260.webp', '2023-02-02'),
(3, 'capsule', 'Risek', 'Omeprazole', '40mg', 'gastric', 'Skin rashes, Paresthesia, Arthralgia ', 'Headache, GI upset, ', 'Medicine', 'GETZ PHARMA PAKISTAN (PVT) LTD', 'Take before meal, best if taken before breakfast, Do not crush or chew capsule', '14', 56, 366, 'Not Required', 'images/risek-40mg.jpg', '2023-02-07'),
(4, 'Tablet', 'Panadol', 'Paracetamol', '500mg', 'For relief of mild to moderate Pain & as antipyretic', 'Cyanosis, hypoglycemia, ', 'Skin eruptions, CNS stimulation', 'Medicine', 'GLAXOSMITHKLINE', 'Take oral form with or without meals.', '10 ', 99, 28, 'Not Required', 'images/panadol.jpeg', '2023-02-07'),
(5, 'Tablet', 'Ponstan', 'Mefenamic', '250mg', 'Mild', 'Edema, Renal impairment, Raised Liver enzymes', 'GI intolerance, Skin rashes', 'Medicine', 'PFIZER LABORATORIES LTD', 'Immediate after meal,, avois taking with antacids', '10', 200, 30, 'Not Required', 'images/ponstan-tablets-250-mg-600s.webp', '2023-02-07'),
(6, 'Suspension', 'Brufen', 'Ibuprofen', '100mg/5ml', 'Rheumotoid arthritis, juvenile rheumatoid arthritis,  Mils to moderate pain and fever', 'rarely aseptic menningitis', 'GI upset  or bleeding', 'Medicine', 'ABBOTT LABORATORIES (PAKISTAN) LIMITED', 'Immediate after meal, Take with glass of water', '120ml', 5, 70, 'Not Required', 'images/brufen serup.png', '2023-02-07'),
(8, 'Tablet', 'Rivotril', 'Clonazepam', '2mg', 'Epilepsy', 'Ataxia, respiratory dipression', 'Fatigue, Muscle weakness, Dizziness', 'Medicine', 'MARTIN DOW PHARMACEUTICALS (PAK) LTD', 'Do not stop taking medicine abruptly, Take oral form with or without meal', '30', 30, 150, 'Required', 'images/rivotrill 2mg.webp', '2023-02-07'),
(9, 'Tablet', 'Corace', 'Lisinopril', '10mg', 'Hypertension,', 'Renal Failure ', 'Hypotension, Pruritic,  anemia', 'Medicine', 'BOSCH PHARMACEUTICALS (PVT) LTD', 'one hour before or 2 hours after meals ', '10', 20, 100, 'Not Required', 'images/corace-10mg-tablets.jpg', '2023-02-07'),
(10, 'Tablet', 'Arnil', 'Diclofenac', '50mg', 'Migraine,', 'gastro-intestinal disorder  GI upset', 'Blood descries ', 'Medicine', 'BROOKES PHARMACEUTICAL LABORATORIES (PAK). LTD', 'take with meal to reduce GI discomfort', '10', 20, 80, 'Not Required', 'images/arnil 50mg.jpeg', '2023-02-07'),
(11, 'capsule', 'Losec', 'Omeprazole', '20mg', 'gastric', 'Hemolysis, Arrhythmias', 'Skin eruptions, CNS stimulation', 'Medicine', 'BARRETT HODGSON PAKISTAN', 'Take before meal, best if taken before breakfast, Do not crush or chew capsule', '14', 21, 732, 'Required', 'images/Losec 20mg.webp', '2023-02-07'),
(12, 'Tablet', 'Cecon', 'Vitamin', '500mg', 'Scurvy,', 'Hyperoxaluria, dizziness ', 'Faintness, Fatigue, Flank pain, Headache', 'Nutrition & Supplements', 'ABBOTT LABORATORIES (PAKISTAN) LIMITED', 'Take with or without meals, Do not swallow whole', '40', 198, 140, 'Not Required', 'images/Cecon 500mg.jpg', '2023-02-08'),
(13, 'Tablet', 'Ogrel', 'clopidogrel', '75mg', 'Ischemic', 'Stevens- Johnson syndrome', 'Bleeding episode, GI upset', 'Medicine', 'BOSCH PHARMACEUTICALS (PVT) LTD', 'inform Pharmacist or physician before any surgery, Take with or without meal ', '10', 90, 155, 'Required', 'images/orgrel 75mgjpg.jpg', '2023-02-08');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_country` varchar(255) NOT NULL,
  `u_address` varchar(255) NOT NULL,
  `u_phone` varchar(255) NOT NULL,
  `delivery_status` varchar(255) NOT NULL,
  `p_id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `generic_name` varchar(255) NOT NULL,
  `p_quantity` int(11) NOT NULL,
  `p_price` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `p_prescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `u_id`, `u_name`, `u_country`, `u_address`, `u_phone`, `delivery_status`, `p_id`, `p_name`, `generic_name`, `p_quantity`, `p_price`, `date`, `order_status`, `p_prescription`) VALUES
(1, 2, 'Faheem', 'PK', 'Bhitai Colony Near Aman Tower Korangi Crossing Karachi', '03032259008', 'cash on delivery', 13, 'Ogrel', 'clopidogrel', 1, 155, '2023-02-07 22:53:24', 'Pending', 'images/stp.jpeg'),
(2, 2, 'Faheem', 'PK', 'Bhitai Colony Near Aman Tower Korangi Crossing Karachi', '03032259008', 'cash on delivery', 11, 'losec', 'Omeprazole', 1, 732, '2023-02-07 22:53:24', 'Pending', 'images/vitamin.jpeg'),
(3, 3, 'Arsalan Warsi ', 'PK', 'Gulistan E Johar', '+923150207265', 'cash on delivery', 1, 'Atarax', '', 1, 34, '2024-08-10 00:30:39', 'Pending', ''),
(4, 3, 'Arsalan Warsi ', 'PK', 'Gulistan E Johar', '+923150207265', 'cash on delivery', 4, 'Panadol', '', 1, 28, '2024-08-10 00:30:39', 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `rating1` varchar(255) NOT NULL,
  `review` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `u_id`, `u_name`, `rating1`, `review`, `date`) VALUES
(1, 2, 'Faheem', '5', 'Good Experience', '2023-02-07 22:45:34'),
(2, 2, 'Faheem', '5', 'hwll', '2023-02-07 22:45:34');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `name`, `email`, `password`, `role`, `date`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', 1, '2023-01-28 19:46:22'),
(2, 'Faheem', 'faheem@gmail.com', '123', 2, '2023-01-28 19:47:17'),
(3, 'Arsalan Warsi ', 'mohammadarsalanwarsi@gmail.com', '1234', 2, '2024-08-09 21:30:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
