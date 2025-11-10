-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql203.byetcluster.com
-- Generation Time: Nov 10, 2025 at 03:22 PM
-- Server version: 11.4.7-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_38847374_Final`
--

-- --------------------------------------------------------

--
-- Table structure for table `banned_ips`
--

CREATE TABLE `banned_ips` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `banned_by` int(11) DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `status` enum('published','draft') NOT NULL DEFAULT 'published',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `slug`, `content`, `excerpt`, `author_id`, `featured_image`, `status`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(11, 'Exchange Bridge - বাংলাদেশী ফ্রিল্যান্সারদের জন্য সেরা পেমেন্ট সমাধান', 'Exchange-Bridge', '<h1><span style=\"font-family: \'Noto Sans Bengali\', \'Hind Siliguri\', SutonnyMJ, Kalpurush, Arial, sans-serif; font-size: 16px; font-weight: 400;\">বাংলাদেশের প্রতিটি ফ্রিল্যান্সার, অনলাইন উদ্যোক্তা এবং ডিজিটাল মার্কেটপ্লেসে কাজ করা প্রত্যেকের জন্য একটি বড় সমস্যা হলো আন্তর্জাতিক পেমেন্ট প্ল্যাটফর্ম থেকে টাকা তোলা। আপনি যদি Fiverr, Upwork, Freelancer.com কিংবা অন্য কোনো আন্তর্জাতিক প্ল্যাটফর্মে কাজ করেন, তাহলে নিশ্চয়ই জানেন যে PayPal, Payoneer, Skrill, বা Wise থেকে টাকা তোলা কতটা জটিল এবং সময়সাপেক্ষ হতে পারে।</span></h1>\r\n<p>আর এই সমস্যার স্থায়ী সমাধান নিয়ে হাজির হয়েছে <strong>Exchange Bridge</strong> - বাংলাদেশের সবচেয়ে নির্ভরযোগ্য এবং দ্রুততম পেমেন্ট এক্সচেঞ্জ সেবা।</p>\r\n<h2>Exchange Bridge কি এবং কেন এটি আপনার প্রয়োজন?</h2>\r\n<p> </p>\r\n<p> </p>\r\n<p>Exchange Bridge হলো একটি বিশেষায়িত আর্থিক সেবা যা বাংলাদেশী ফ্রিল্যান্সার এবং অনলাইন ব্যবসায়ীদের জন্য ডিজাইন করা হয়েছে। আমরা আন্তর্জাতিক পেমেন্ট প্ল্যাটফর্ম এবং স্থানীয় পেমেন্ট সিস্টেমের মধ্যে একটি সেতুর কাজ করি। যেখানে অন্যান্য সেবা জটিল প্রক্রিয়া এবং দীর্ঘ অপেক্ষার সময় নিয়ে আসে, সেখানে Exchange Bridge এর মাধ্যমে আপনি মিনিটের মধ্যেই আপনার কষ্টার্জিত অর্থ হাতে পেতে পারেন।</p>\r\n<h3>আমাদের মূল বৈশিষ্ট্যসমূহ:</h3>\r\n<p><strong>১. সর্বোচ্চ নিরাপত্তা ও গোপনীয়তা</strong> আপনার আর্থিক তথ্য এবং ব্যক্তিগত ডেটার নিরাপত্তা আমাদের সর্বোচ্চ অগ্রাধিকার। আমরা আন্তর্জাতিক মানের এনক্রিপশন এবং নিরাপত্তা ব্যবস্থা ব্যবহার করি যাতে আপনার প্রতিটি লেনদেন সম্পূর্ণ নিরাপদ থাকে। আমাদের সিস্টেম ২৪/৭ মনিটর করা হয় এবং যেকোনো সন্দেহজনক কার্যকলাপ তাৎক্ষণিকভাবে শনাক্ত করা হয়।</p>\r\n<p><strong>২. প্রতিযোগিতামূলক রেট ও স্বচ্ছতা</strong> বাজারে সেরা রেট নিশ্চিত করতে আমরা প্রতিদিন আন্তর্জাতিক মুদ্রার দর অনুসরণ করি। আমাদের রেট সম্পূর্ণ স্বচ্ছ - কোনো লুকানো ফি বা অতিরিক্ত চার্জ নেই। আপনি যা দেখবেন, ঠিক ততটাই পাবেন। আমাদের ক্যালকুলেটর ব্যবহার করে লেনদেনের আগেই জেনে নিতে পারবেন আপনি কত টাকা পাবেন।</p>\r\n<p><strong>৩. বিস্তৃত পেমেন্ট অপশন</strong> আমরা জানি যে প্রত্যেকের পছন্দ আলাদা। তাই আমরা বিভিন্ন ধরনের পেমেন্ট অপশন সরবরাহ করি:</p>\r\n<ul>\r\n<li>বিকাশ (bKash) - বাংলাদেশের সবচেয়ে জনপ্রিয় মোবাইল ব্যাংকিং</li>\r\n<li>নগদ (Nagad) - দ্রুত এবং সহজ লেনদেনের জন্য</li>\r\n<li>রকেট (Rocket) - ডাচ-বাংলা ব্যাংকের নির্ভরযোগ্য সেবা</li>\r\n<li>ব্যাংক ট্রান্সফার - সকল প্রধান বাংলাদেশী ব্যাংকে সরাসরি ট্রান্সফার</li>\r\n<li>উপায় (Upay) - আধুনিক ডিজিটাল পেমেন্ট সলিউশন</li>\r\n</ul>\r\n<p><strong>৪. ২৪/৭ গ্রাহক সহায়তা</strong> আমাদের অভিজ্ঞ গ্রাহক সহায়তা দল সর্বদা আপনার সেবায় নিয়োজিত। দিন-রাত, সপ্তাহের যেকোনো দিন আপনি আমাদের সাথে যোগাযোগ করতে পারেন। আমাদের সাপোর্ট টিম বাংলা এবং ইংরেজি দুই ভাষায়ই সাবলীল এবং যেকোনো সমস্যার দ্রুত সমাধান প্রদান করতে সক্ষম।</p>\r\n<h2>আমরা যেসব পেমেন্ট প্ল্যাটফর্ম সাপোর্ট করি</h2>\r\n<p><strong>PayPal থেকে টাকা তোলা</strong> PayPal বিশ্বের সবচেয়ে জনপ্রিয় অনলাইন পেমেন্ট সিস্টেম। কিন্তু বাংলাদেশে PayPal থেকে সরাসরি টাকা তোলা সম্ভব নয়। Exchange Bridge এর মাধ্যমে আপনি আপনার PayPal অ্যাকাউন্ট থেকে অতি সহজেই টাকা তুলতে পারবেন। আমাদের বিশেষ পদ্ধতির কারণে এই প্রক্রিয়া সম্পূর্ণ আইনি এবং নিরাপদ।</p>\r\n<p><strong>Payoneer এক্সচেঞ্জ সেবা</strong> Payoneer কার্ড বাংলাদেশে বেশ জনপ্রিয়, কিন্তু ATM থেকে টাকা তোলার সময় অনেক ফি দিতে হয়। আমাদের সেবা ব্যবহার করে আপনি Payoneer থেকে সরাসরি আপনার মোবাইল ব্যাংকিং বা ব্যাংক অ্যাকাউন্টে টাকা ট্রান্সফার করতে পারবেন কম খরচে।</p>\r\n<p><strong>Skrill মানি এক্সচেঞ্জ</strong> ইউরোপিয়ান ক্লায়েন্টদের কাছ থেকে Skrill এর মাধ্যমে পেমেন্ট পাওয়া খুবই সাধারণ। আমাদের সেবার মাধ্যমে Skrill থেকে টাকা তোলা এখন আগের চেয়ে অনেক সহজ এবং দ্রুত।</p>\r\n<p><strong>Wise (পূর্বে TransferWise) এক্সচেঞ্জ</strong> আন্তর্জাতিক ব্যাংকিং এর জন্য Wise একটি নির্ভরযোগ্য প্ল্যাটফর্ম। আমরা Wise থেকে বাংলাদেশী টাকায় রূপান্তরের সম্পূর্ণ সেবা প্রদান করি।</p>\r\n<p><strong>অন্যান্য প্ল্যাটফর্ম</strong> আমরা Neteller, Perfect Money, WebMoney এবং আরো অনেক আন্তর্জাতিক পেমেন্ট সিস্টেম সাপোর্ট করি। যদি আপনার কোনো বিশেষ প্রয়োজন থাকে, আমাদের সাথে যোগাযোগ করুন।</p>\r\n<h2>আমাদের সেবা ব্যবহারের সহজ প্রক্রিয়া</h2>\r\n<p><strong>ধাপ ১: রেজিস্ট্রেশন ও যাচাইকরণ</strong> প্রথমে আমাদের ওয়েবসাইট http://exchange-bridge.rf.gd তে গিয়ে একটি অ্যাকাউন্ট তৈরি করুন। আমাদের রেজিস্ট্রেশন প্রক্রিয়া অত্যন্ত সহজ এবং মাত্র কয়েক মিনিটেই সম্পন্ন হয়। নিরাপত্তার জন্য আপনার জাতীয় পরিচয়পত্র বা পাসপোর্টের একটি কপি আপলোড করতে হবে।</p>\r\n<p><strong>ধাপ ২: এক্সচেঞ্জ অর্ডার তৈরি</strong> আপনার ড্যাশবোর্ড থেকে একটি নতুন এক্সচেঞ্জ অর্ডার তৈরি করুন। এখানে আপনাকে বলতে হবে:</p>\r\n<ul>\r\n<li>কোন প্ল্যাটফর্ম থেকে টাকা এক্সচেঞ্জ করতে চান</li>\r\n<li>কত পরিমাণ অর্থ এক্সচেঞ্জ করবেন</li>\r\n<li>কোন মাধ্যমে টাকা নিতে চান (বিকাশ/নগদ/ব্যাংক)</li>\r\n<li>আপনার পেমেন্ট রিসিভিং অ্যাকাউন্টের তথ্য</li>\r\n</ul>\r\n<p><strong>ধাপ ৩: পেমেন্ট ট্রান্সফার</strong> আমাদের প্রদত্ত নির্দেশনা অনুযায়ী আপনার আন্তর্জাতিক অ্যাকাউন্ট থেকে আমাদের নির্দিষ্ট অ্যাকাউন্টে টাকা পাঠান। আমাদের রিয়েল-টাইম ট্র্যাকিং সিস্টেমের মাধ্যমে আপনি জানতে পারবেন টাকা কখন পৌঁছেছে।</p>\r\n<p><strong>ধাপ ৪: তাৎক্ষণিক টাকা প্রাপ্তি</strong> আমাদের কাছে আপনার পেমেন্ট পৌঁছানোর সাথে সাথেই আমরা আপনার নির্দিষ্ট করা অ্যাকাউন্টে বাংলাদেশী টাকা পাঠিয়ে দেব। সাধারণত এই পুরো প্রক্রিয়া ১৫-৩০ মিনিটের মধ্যে সম্পন্ন হয়।</p>\r\n<h2>বিশেষ সুবিধা এবং অফার</h2>\r\n<p><strong>নতুন গ্রাহকদের জন্য বোনাস</strong> প্রথমবার আমাদের সেবা ব্যবহারকারীরা পাবেন ১% অতিরিক্ত বোনাস। এটি আপনার প্রথম এক্সচেঞ্জের সাথে সাথেই যোগ হয়ে যাবে।</p>\r\n<p><strong>নিয়মিত গ্রাহকদের জন্য লয়ালটি প্রোগ্রাম</strong> যারা নিয়মিত আমাদের সেবা ব্যবহার করেন, তাদের জন্য রয়েছে বিশেষ ছাড় এবং সুবিধা। প্রতি মাসে ৫০,০০০ টাকার বেশি এক্সচেঞ্জ করলে পাবেন VIP স্ট্যাটাস এবং প্রাধিকার সেবা।</p>\r\n<p><strong>গ্রুপ এক্সচেঞ্জ সুবিধা</strong> আপনি যদি কোনো টিম বা গ্রুপের সাথে কাজ করেন, তাহলে আমাদের গ্রুপ এক্সচেঞ্জ সুবিধা ব্যবহার করতে পারেন। এতে সবার জন্য আরো ভালো রেট পাবেন।</p>\r\n<h2>নিরাপত্তা ব্যবস্থা</h2>\r\n<p><strong>SSL এনক্রিপশন</strong> আমাদের ওয়েবসাইট এবং সকল লেনদেন 256-bit SSL এনক্রিপশন দ্বারা সুরক্ষিত। এটি নিশ্চিত করে যে আপনার কোনো তথ্য তৃতীয় পক্ষের হাতে পড়বে না।</p>\r\n<p><strong>দ্বি-ফ্যাক্টর অথেন্টিকেশন (2FA)</strong> অতিরিক্ত নিরাপত্তার জন্য আমরা 2FA সিস্টেম ব্যবহার করি। আপনার মোবাইল নম্বরে পাঠানো OTP ছাড়া কেউ আপনার অ্যাকাউন্ট অ্যাক্সেস করতে পারবে না।</p>\r\n<p><strong>অ্যান্টি-ফ্রড সিস্টেম</strong> আমাদের কৃত্রিম বুদ্ধিমত্তা চালিত অ্যান্টি-ফ্রড সিস্টেম প্রতিটি লেনদেন পর্যবেক্ষণ করে এবং সন্দেহজনক কার্যকলাপ শনাক্ত করে।</p>\r\n<h2>ফ্রিল্যান্সারদের জন্য বিশেষ সেবা</h2>\r\n<p><strong>ট্যাক্স সাপোর্ট</strong> আমরা আপনাকে আপনার সকল লেনদেনের বিস্তারিত রিপোর্ট প্রদান করি যা আপনার ট্যাক্স রিটার্ন ফাইল করতে সাহায্য করবে। আমাদের অ্যাকাউন্টিং টিম ট্যাক্স সংক্রান্ত যেকোনো প্রশ্নের উত্তর দিতে প্রস্তুত।</p>\r\n<p><strong>ব্যাচ পেমেন্ট সুবিধা</strong> যদি আপনার একাধিক ক্লায়েন্ট থেকে একসাথে অনেক পেমেন্ট আসে, তাহলে আমাদের ব্যাচ পেমেন্ট সুবিধা ব্যবহার করতে পারেন। এতে সময় এবং খরচ দুটোই বাঁচবে।</p>\r\n<p><strong>ইনভয়েস জেনারেটর</strong> আমাদের ফ্রি ইনভয়েস জেনারেটর টুল ব্যবহার করে পেশাদার ইনভয়েস তৈরি করুন এবং আপনার ক্লায়েন্টদের কাছে পাঠান।</p>\r\n<h2>গ্রাহক সেবা ও সাপোর্ট</h2>\r\n<p><strong>যোগাযোগের মাধ্যম</strong></p>\r\n<ul>\r\n<li><strong>মোবাইল নম্বর</strong>: <a href=\"tel:008801730250576\">008801730250576</a>, <a href=\"tel:0097474414725\">0097474414725</a></li>\r\n<li><strong>ইমেইল</strong>: paymentbridge.bd@gmail.com (শীঘ্রই আপডেট হবে exchangebridge.bd@gmail.com)</li>\r\n<li><strong>লাইভ চ্যাট</strong>: আমাদের ওয়েবসাইটে 24/7 লাইভ চ্যাট সুবিধা</li>\r\n<li><strong>সোশ্যাল মিডিয়া</strong>: ফেসবুক, টেলিগ্রাম, হোয়াটসঅ্যাপে আমাদের ফলো করুন</li>\r\n</ul>\r\n<p><strong>সাপোর্টের ভাষা</strong> আমাদের সাপোর্ট টিম বাংলা এবং ইংরেজি দুই ভাষায়ই দক্ষ। আপনি যেকোনো ভাষায় আমাদের সাথে কথা বলতে পারেন।</p>\r\n<p><strong>রেসপন্স টাইম</strong></p>\r\n<ul>\r\n<li>ইমেইল: ২ ঘন্টার মধ্যে</li>\r\n<li>লাইভ চ্যাট: তাৎক্ষণিক</li>\r\n<li>ফোন কল: সর্বোচ্চ ৩টি রিং এর মধ্যে</li>\r\n</ul>\r\n<h2>আমাদের সাফল্যের গল্প</h2>\r\n<p>গত তিন বছরে আমরা বাংলাদেশের হাজার হাজার ফ্রিল্যান্সারকে তাদের আন্তর্জাতিক আয় স্থানীয় মুদ্রায় রূপান্তর করতে সাহায্য করেছি। আমাদের গ্রাহকরা মাসিক গড়ে ৫ কোটি টাকার বেশি এক্সচেঞ্জ করেন। আমাদের গ্রাহক সন্তুষ্টির হার ৯৮.৫% যা ইন্ডাস্ট্রিতে সর্বোচ্চ।</p>\r\n<h2>ভবিষ্যৎ পরিকল্পনা</h2>\r\n<p><strong>মোবাইল অ্যাপ লঞ্চ</strong> আগামী কয়েক মাসের মধ্যে আমরা আমাদের মোবাইল অ্যাপ্লিকেশন লঞ্চ করব যা Android এবং iOS দুই প্ল্যাটফর্মেই পাওয়া যাবে।</p>\r\n<p><strong>ক্রিপ্টোকারেন্সি সাপোর্ট</strong> আমরা শীঘ্রই Bitcoin, Ethereum এবং অন্যান্য জনপ্রিয় ক্রিপ্টোকারেন্সি এক্সচেঞ্জ সেবা যোগ করব।</p>\r\n<p><strong>রেমিট্যান্স সেবা</strong> বিদেশে কর্মরত বাংলাদেশীদের জন্য রেমিট্যান্স সেবা চালু করার পরিকল্পনা রয়েছে।</p>\r\n<h2>প্রায়শই জিজ্ঞাসিত প্রশ্ন</h2>\r\n<p><strong>প্রশ্ন: এক্সচেঞ্জ রেট কিভাবে নির্ধারণ করা হয়?</strong> উত্তর: আমাদের রেট আন্তর্জাতিক মুদ্রা বাজারের উপর ভিত্তি করে নির্ধারিত হয় এবং প্রতিদিন আপডেট করা হয়।</p>\r\n<p><strong>প্রশ্ন: সর্বনিম্ন এবং সর্বোচ্চ এক্সচেঞ্জ লিমিট কত?</strong> উত্তর: প্রতি লেনদেনে সর্বনিম্ন ১০ ডলার এবং সর্বোচ্চ ৫,০০০ ডলার এক্সচেঞ্জ করতে পারবেন।</p>\r\n<p><strong>প্রশ্ন: কোনো লেনদেন বাতিল করা যায় কি?</strong> উত্তর: হ্যাঁ, পেমেন্ট কনফার্ম হওয়ার আগে যেকোনো সময় অর্ডার বাতিল করতে পারবেন।</p>\r\n<h2>আজই শুরু করুন</h2>\r\n<p>আপনার ফ্রিল্যান্সিং ক্যারিয়ারে আর্থিক বাধা দূর করুন। Exchange Bridge এর সাথে যুক্ত হয়ে আপনার আন্তর্জাতিক আয়কে সহজেই বাংলাদেশী টাকায় রূপান্তর করুন। আমাদের নির্ভরযোগ্য, দ্রুত এবং নিরাপদ সেবা একবার ব্যবহার করে দেখুন - আমরা নিশ্চিত যে আপনি আমাদের সেবায় সন্তুষ্ট হবেন।</p>\r\n<p><strong>ওয়েবসাইট</strong>: http://exchange-bridge.rf.gd <strong>ফোন</strong>: <a href=\"tel:008801730250576\">008801730250576</a>, <a href=\"tel:0097474414725\">0097474414725</a> <strong>ইমেইল</strong>: paymentbridge.bd@gmail.com</p>\r\n<p><strong>Exchange Bridge - আপনার আন্তর্জাতিক আয়ের নির্ভরযোগ্য সেতু।</strong></p>\r\n<hr>\r\n<p><em>Exchange Bridge একটি রেজিস্টার্ড আর্থিক সেবা প্রতিষ্ঠান। আমরা বাংলাদেশ ব্যাংকের সকল নিয়মকানুন মেনে চলি এবং গ্রাহকদের অর্থের সর্বোচ্চ নিরাপত্তা নিশ্চিত করি।</em></p>', 'Exchange Bridge দিয়ে PayPal, Payoneer, Skrill এক্সচেঞ্জ করুন নিরাপদভাবে। ফ্রিল্যান্সারদের বিশ্বস্ত পার্টনার। সেরা রেট + ২৪/৭ সাপোর্ট।', 1, '1749130885_68419e8518f96.jpeg', 'published', 'Exchange Bridge - বাংলাদেশী ফ্রিল্যান্সারদের জন্য সেরা পেমেন্ট সমাধান', 'Exchange Bridge দিয়ে PayPal, Payoneer, Skrill এক্সচেঞ্জ করুন নিরাপদভাবে। ফ্রিল্যান্সারদের বিশ্বস্ত পার্টনার। সেরা রেট + ২৪/৭ সাপোর্ট।', '', '2025-06-05 13:41:25', '2025-06-05 13:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `display_name` varchar(100) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `background_class` varchar(100) DEFAULT NULL,
  `icon_class` varchar(100) DEFAULT NULL,
  `payment_address` varchar(255) DEFAULT NULL,
  `address_label` varchar(100) DEFAULT NULL,
  `address_type` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `name`, `display_name`, `logo`, `background_class`, `icon_class`, `payment_address`, `address_label`, `address_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BDT', 'bKash BDT', 'BDT', '6841e092832aa.png', 'bg-pink-100 text-pink-500', 'fas fa-money-bill-wave', '01712345678', 'bKash Mobile Number', 'এই নাম্বারে আপনার টাকা সেন্ড করা হবে', 'active', '2025-05-26 08:10:00', '2025-07-05 16:17:29'),
(2, 'Paypal', 'PayPal USD', 'USD', '6841ddb3092d7.jpeg', 'bg-blue-500 text-white', 'fab fa-paypal', 'paypal@example.com', 'PayPal Email Address', 'email address', 'active', '2025-05-26 08:10:00', '2025-06-05 18:10:58'),
(3, 'BTC', 'Bitcoin BTC', 'BTC', '686aa46f2d2e2.png', 'bg-yellow-500 text-white', 'fab fa-bitcoin', '01869838872', 'Bitcoin Wallet Address', 'wallet address', 'active', '2025-05-26 08:10:00', '2025-07-06 16:29:35'),
(4, 'PM', 'Perfect Money USD', 'USD', NULL, 'bg-red-100 text-red-500', 'fas fa-money-bill-wave', 'U1234567', 'Perfect Money Account', 'account number', 'active', '2025-05-26 08:10:00', '2025-05-26 08:10:00'),
(5, 'BD', 'IBBL', 'BDT', '6841dd4364192.png', '', '', '20501280203638303', 'Islami Bank, Beanibazar', 'Account Number', 'active', '2025-05-26 09:09:17', '2025-06-05 18:09:06'),
(6, 'Payoneer', 'Payoneer', 'USD', '6841dce58a387.jpeg', '', '', 'Msa.Masum.Bd@gmail.com', 'Email', 'Pay', 'active', '2025-05-26 09:10:31', '2025-06-05 18:07:32'),
(9, 'Nagad', 'Nagad BDT', 'BDT', '6841e0a21868e.png', '', '', '01869838872', '', '', 'active', '2025-06-05 16:11:31', '2025-06-05 18:23:30'),
(10, 'Rocket', 'Rocket BDT', 'BDT', '6841dd2c7efb7.jpeg', '', '', '', '', '', 'active', '2025-06-05 17:54:53', '2025-06-05 18:08:43'),
(11, 'DBBL', 'Dutch Bangla Bank Limited', 'DBBL BDT', '6841de79b4f18.jpeg', '', '', '', '', '', 'active', '2025-06-05 18:14:16', '2025-06-05 18:14:16'),
(12, 'UPay', 'Upay Mobile Money', 'UPAY BDT', '6841dead54dcf.png', '', '', '', '', '', 'active', '2025-06-05 18:15:09', '2025-06-05 18:15:09'),
(13, 'RedotPay', 'Redot Pay', 'Redot Pay USD', '6841df24740e4.jpeg', '', '', '', '', '', 'active', '2025-06-05 18:17:08', '2025-06-05 18:17:08'),
(14, 'CELLFIN', 'CellFin Islami Bank', 'CellFin', '686950d16b87b.jpeg', '', '', '', '', 'এই নাম্বারে টাকা পাঠানো হবে', 'active', '2025-07-05 16:20:33', '2025-07-05 16:20:33'),
(15, 'RrUSD', 'Bill Payment', 'USDy', '6869a6e8cf2a2.jpeg', '', '', '', '', '', 'active', '2025-07-05 22:27:52', '2025-07-07 07:52:43'),
(16, 'Taka', 'Bangladeshi Taka', 'BDT', '6869a714aff63.png', '', '', '', '', '', 'active', '2025-07-05 22:28:36', '2025-07-07 07:45:00'),
(17, 'QAR', 'Qatari Riyal', 'QR', '6869a7436faf6.png', '', '', '', '', '', 'active', '2025-07-05 22:29:23', '2025-07-07 07:45:46'),
(18, 'USD', 'Bybit Recharge', 'USD', '686b7a9e7a3aa.jpeg', '', '', '', '', '', 'active', '2025-07-07 07:29:25', '2025-07-07 07:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `currency_rates`
--

CREATE TABLE `currency_rates` (
  `id` int(11) NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `we_buy_rate` decimal(10,2) DEFAULT NULL,
  `we_sell_rate` decimal(10,2) DEFAULT NULL,
  `is_enabled` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `template_key` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `variables` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `template_key`, `subject`, `body`, `variables`, `status`, `created_at`, `updated_at`) VALUES
(1, 'email_verification', 'Verify Your Email - {site_name}', '<h2>Welcome to {site_name}!</h2>\n<p>Hi {name},</p>\n<p>Thank you for signing up! Please verify your email address by clicking the link below:</p>\n<p><a href=\"{verification_link}\" style=\"background-color: #5D5CDE; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; display: inline-block;\">Verify Email</a></p>\n<p>Or copy and paste this link in your browser:</p>\n<p>{verification_link}</p>\n<p>Your verification code is: <strong>{verification_code}</strong></p>\n<p>This link will expire in 24 hours.</p>\n<p>If you didn\'t create an account, please ignore this email.</p>\n<p>Best regards,<br>{site_name} Team</p>', 'name,site_name,verification_link,verification_code', 'active', '2025-08-29 15:33:51', '2025-08-29 15:33:51'),
(2, 'password_reset', 'Password Reset - {site_name}', '<h2>Password Reset Request</h2>\n<p>Hi {name},</p>\n<p>We received a request to reset your password for your {site_name} account.</p>\n<p>Click the link below to reset your password:</p>\n<p><a href=\"{reset_link}\" style=\"background-color: #5D5CDE; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; display: inline-block;\">Reset Password</a></p>\n<p>Or copy and paste this link in your browser:</p>\n<p>{reset_link}</p>\n<p>This link will expire in 1 hour.</p>\n<p>If you didn\'t request this password reset, please ignore this email.</p>\n<p>Best regards,<br>{site_name} Team</p>', 'name,site_name,reset_link', 'active', '2025-08-29 15:33:51', '2025-08-29 15:33:51'),
(3, 'welcome_email', 'Welcome to {site_name}!', '<h2>Welcome to {site_name}!</h2>\n<p>Hi {name},</p>\n<p>Your account has been successfully created! Your User ID is: <strong>{user_id}</strong></p>\n<p>You can now:</p>\n<ul>\n<li>Exchange currencies with auto-filled forms</li>\n<li>View your transaction history</li>\n<li>Manage your profile</li>\n</ul>\n<p><a href=\"{dashboard_link}\" style=\"background-color: #5D5CDE; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; display: inline-block;\">Go to Dashboard</a></p>\n<p>Best regards,<br>{site_name} Team</p>', 'name,site_name,user_id,dashboard_link', 'active', '2025-08-29 15:33:51', '2025-08-29 15:33:51');

-- --------------------------------------------------------

--
-- Table structure for table `exchanges`
--

CREATE TABLE `exchanges` (
  `id` int(11) NOT NULL,
  `reference_id` varchar(20) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_phone` varchar(50) NOT NULL,
  `payment_address` varchar(255) NOT NULL,
  `from_currency` varchar(10) NOT NULL,
  `to_currency` varchar(10) NOT NULL,
  `send_amount` decimal(20,8) NOT NULL,
  `receive_amount` decimal(20,8) NOT NULL,
  `exchange_rate` decimal(20,8) NOT NULL,
  `status` enum('pending','confirmed','cancelled','refunded') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exchanges`
--

INSERT INTO `exchanges` (`id`, `reference_id`, `customer_name`, `customer_email`, `customer_phone`, `payment_address`, `from_currency`, `to_currency`, `send_amount`, `receive_amount`, `exchange_rate`, `status`, `created_at`, `updated_at`) VALUES
(26, 'EB-25070801', 'Saieed Rahman', 'msa.masum_info@yahoo.com', '008801730250576', '32 Al Aamriya St., Madinat Khalifa North', 'BTC', 'BDT', '60.00000000', '6720.00000000', '112.00000000', 'pending', '2025-07-08 15:00:53', '2025-07-08 15:00:53'),
(27, 'EB-25070802', 'Saieed Rahman', 'msa.masum_info@yahoo.com', '008801730250576', '32 Al Aamriya St., Madinat Khalifa North', 'BTC', 'BDT', '50.00000000', '5600.00000000', '112.00000000', 'pending', '2025-07-08 15:22:41', '2025-07-08 15:22:41'),
(28, 'EB-25070803', 'Saieed Rahman', 'msa.masum_info@yahoo.com', '008801730250576', '32 Al Aamriya St., Madinat Khalifa North', 'BTC', 'BDT', '60.00000000', '6720.00000000', '112.00000000', 'pending', '2025-07-08 17:02:55', '2025-07-08 17:02:55'),
(29, 'EB-25070804', 'Saieed Rahman', 'msa.masum_info@yahoo.com', '008801730250576', '32 Al Aamriya St., Madinat Khalifa North', 'BTC', 'BDT', '60.00000000', '6720.00000000', '112.00000000', 'pending', '2025-07-08 17:08:10', '2025-07-08 17:08:10'),
(30, 'EB-25070805', 'Saieed Rahman', 'msa.masum_info@yahoo.com', '008801730250576', '32 Al Aamriya St., Madinat Khalifa North', 'BTC', 'BDT', '600.00000000', '67200.00000000', '112.00000000', 'pending', '2025-07-08 17:46:06', '2025-07-08 17:46:06'),
(31, 'EB-25072269', 'Saieed Rahman', 'msa.masum_info@yahoo.com', '008801730250576', '32 Al Aamriya St., Madinat Khalifa North', 'QAR', 'BDT', '69.00000000', '2311.50000000', '33.50000000', 'pending', '2025-07-22 22:38:46', '2025-07-22 09:38:46'),
(32, 'EB-250722NaN', 'Saieed Rahman', 'msa.masum_info@yahoo.com', '008801730250576', '32 Al Aamriya St., Madinat Khalifa North', 'QAR', 'Taka', '66.00000000', '2211.00000000', '33.50000000', 'pending', '2025-07-22 11:46:04', '2025-07-22 11:46:04'),
(33, 'EB-25072601', 'Saieed Rahman', 'msa.masum_info@yahoo.com', '008801730250576', '32 Al Aamriya St., Madinat Khalifa North', 'BTC', 'BDT', '60.00000000', '6720.00000000', '112.00000000', 'pending', '2025-07-26 15:15:09', '2025-07-26 15:15:09'),
(34, 'EB-250821NaN', 'Saieed Rahman', 'msa.masum_info@yahoo.com', '008801730250576', '32 Al Aamriya St., Madinat Khalifa North', 'QAR', 'Taka', '50.00000000', '1675.00000000', '33.50000000', 'pending', '2025-08-21 06:43:10', '2025-08-21 06:43:10'),
(35, 'EB-25082815', 'Ushs', 'hshsh@gmail.com', '215151181018', 'Hhh', 'QAR', 'Taka', '20.00000000', '670.00000000', '33.50000000', 'pending', '2025-08-28 14:16:03', '2025-08-28 14:16:03'),
(36, 'EB-250831NaN', 'Saieed Rahman', 'msa.masum.bd@gmail.com', '008801730250576', '32 Al Aamriya St., Madinat Khalifa North', 'QAR', 'Taka', '40.00000000', '1340.00000000', '33.50000000', 'pending', '2025-08-31 16:20:36', '2025-08-31 16:20:36'),
(37, 'EB-25090113', 'nhjgh', 'nanshugu@gmail.com', '12e32', 'weqwd', 'BTC', 'BDT', '22.00000000', '2464.00000000', '112.00000000', 'pending', '2025-08-31 22:13:36', '2025-08-31 22:13:36'),
(38, 'EB-250905NaN', 'Saieed Rahman', 'msa.masum_info@yahoo.com', '008801730250576', '32 Al Aamriya St., Madinat Khalifa North', 'BTC', 'BDT', '60.00000000', '6720.00000000', '112.00000000', 'pending', '2025-09-05 19:05:01', '2025-09-05 19:05:01'),
(39, 'EB-250909NaN', 'Saieed Rahman', 'msa.masum_info@yahoo.com', '008801730250576', '32 Al Aamriya St., Madinat Khalifa North', 'QAR', 'Taka', '60.00000000', '2010.00000000', '33.50000000', 'pending', '2025-09-09 09:35:12', '2025-09-09 09:35:12'),
(40, 'EB-25090905', 'DSFF', 'nayannath13@gmail.com', '0188888', 'GHJG', 'QAR', 'Taka', '20.00000000', '670.00000000', '33.50000000', 'pending', '2025-09-09 13:06:01', '2025-09-09 13:06:01'),
(41, 'EB-25110953', 'saieed', 'masum@gmail.com', '0176052551', '111111', 'BTC', 'BDT', '50.00000000', '5600.00000000', '112.00000000', 'pending', '2025-11-08 22:53:48', '2025-11-08 22:53:48'),
(42, 'EB-25111142', 'khjk', 'fkhjkghk@gmail.com', '0173025', '454', 'BTC', 'BDT', '50.00000000', '5600.00000000', '112.00000000', 'pending', '2025-11-10 19:42:08', '2025-11-10 19:42:08'),
(43, 'EB-25111101', 'asfsdf', 'dfgsdfg@gmail.com', '5111', '1515', 'BTC', 'BDT', '50.00000000', '5600.00000000', '112.00000000', 'pending', '2025-11-10 20:03:27', '2025-11-10 20:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_rates`
--

CREATE TABLE `exchange_rates` (
  `id` int(11) NOT NULL,
  `from_currency` varchar(10) NOT NULL,
  `to_currency` varchar(10) NOT NULL,
  `rate` decimal(20,8) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `display_on_homepage` tinyint(1) DEFAULT 0,
  `we_buy` decimal(15,8) DEFAULT 0.00000000,
  `we_sell` decimal(15,8) DEFAULT 0.00000000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exchange_rates`
--

INSERT INTO `exchange_rates` (`id`, `from_currency`, `to_currency`, `rate`, `status`, `created_at`, `updated_at`, `display_on_homepage`, `we_buy`, `we_sell`) VALUES
(11, 'USD', 'BDT', '120.00000000', 'active', '2025-06-01 14:08:54', '2025-06-01 14:08:54', 0, '0.00000000', '0.00000000'),
(12, 'BDT', 'Usdt', '120.00000000', 'active', '2025-06-02 03:06:28', '2025-06-02 03:06:28', 0, '0.00000000', '0.00000000'),
(13, 'BTC', 'BDT', '112.00000000', 'active', '2025-06-02 03:06:47', '2025-06-02 03:06:47', 0, '0.00000000', '0.00000000'),
(14, 'Paypal', 'Nagad', '112.00000000', 'active', '2025-07-03 16:20:48', '2025-07-03 16:20:48', 0, '0.00000000', '0.00000000'),
(15, 'BTC', 'Rocket', '110.00000000', 'active', '2025-07-03 16:21:33', '2025-07-03 16:21:33', 0, '0.00000000', '0.00000000'),
(16, 'Paypal', 'BDT', '111.00000000', 'active', '2025-07-03 16:21:51', '2025-07-03 16:21:51', 0, '0.00000000', '0.00000000'),
(17, 'DBBL', 'Payoneer', '0.00820000', 'active', '2025-07-03 16:22:37', '2025-07-03 16:22:37', 0, '0.00000000', '0.00000000'),
(18, 'BDT', 'RedotPay', '0.00800000', 'active', '2025-07-03 16:23:01', '2025-07-03 16:23:01', 0, '0.00000000', '0.00000000'),
(19, 'Nagad', 'RedotPay', '0.00810000', 'active', '2025-07-03 16:23:24', '2025-07-03 16:23:24', 0, '0.00000000', '0.00000000'),
(20, 'CELLFIN', 'Paypal', '0.00820000', 'active', '2025-07-05 16:21:21', '2025-07-05 16:21:21', 0, '0.00000000', '0.00000000'),
(21, 'QAR', 'Taka', '33.50000000', 'active', '2025-07-05 22:34:38', '2025-07-05 22:34:38', 0, '0.00000000', '0.00000000'),
(22, 'QAR', 'BDT', '33.50000000', 'active', '2025-07-06 15:35:44', '2025-07-06 15:35:44', 1, '33.50000000', '34.00000000'),
(23, 'USD', 'CELLFIN', '50.00000000', 'active', '2025-07-07 07:37:06', '2025-07-07 07:37:06', 1, '50.00000000', '50.00000000');

-- --------------------------------------------------------

--
-- Table structure for table `floating_buttons`
--

CREATE TABLE `floating_buttons` (
  `id` int(11) NOT NULL,
  `button_type` varchar(20) DEFAULT 'custom',
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `custom_icon` varchar(255) DEFAULT '',
  `color` varchar(7) NOT NULL DEFAULT '#25D366',
  `url` text NOT NULL,
  `target` varchar(10) NOT NULL DEFAULT '_blank',
  `position` varchar(20) NOT NULL DEFAULT 'right',
  `order_index` int(11) NOT NULL DEFAULT 0,
  `status` varchar(10) NOT NULL DEFAULT 'active',
  `show_on_mobile` tinyint(1) NOT NULL DEFAULT 1,
  `show_on_desktop` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `floating_buttons`
--

INSERT INTO `floating_buttons` (`id`, `button_type`, `title`, `icon`, `custom_icon`, `color`, `url`, `target`, `position`, `order_index`, `status`, `show_on_mobile`, `show_on_desktop`, `created_at`, `updated_at`) VALUES
(17, 'custom', 'WhatsApp Support', 'fab fa-whatsapp', 'uploads/icons/icon_1751833540_686adbc4ca18f.png', '#25d366', 'https://wa.me/97466489944', '_blank', 'bottom-left', 0, 'inactive', 1, 1, '2025-07-06 20:25:40', '2025-07-06 20:31:52'),
(18, 'custom', 'Live Chat Support', 'fas fa-comments', 'uploads/icons/icon_1751835873_686ae4e1050fc.jpeg', '#1e90ff', '6869a98370e7fd1919383828/1ivebsat9', '_blank', 'bottom-right', 0, 'inactive', 1, 1, '2025-07-06 20:51:41', '2025-07-06 21:04:45');

-- --------------------------------------------------------

--
-- Table structure for table `license_logs`
--

CREATE TABLE `license_logs` (
  `id` int(11) NOT NULL,
  `event_type` varchar(50) NOT NULL,
  `license_key` varchar(255) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_settings`
--

CREATE TABLE `mail_settings` (
  `id` int(11) NOT NULL,
  `smtp_host` varchar(255) DEFAULT 'smtp.gmail.com',
  `smtp_port` int(11) DEFAULT 587,
  `smtp_secure` enum('tls','ssl') DEFAULT 'tls',
  `smtp_auth` tinyint(1) DEFAULT 1,
  `smtp_username` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `from_email` varchar(255) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `reply_to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mail_settings`
--

INSERT INTO `mail_settings` (`id`, `smtp_host`, `smtp_port`, `smtp_secure`, `smtp_auth`, `smtp_username`, `smtp_password`, `from_email`, `from_name`, `reply_to`, `created_at`, `updated_at`) VALUES
(1, 'smtp.gmail.com', 587, 'tls', 1, NULL, NULL, 'your-email@gmail.com', 'Exchange Bridge', NULL, '2025-09-09 12:01:09', '2025-09-09 12:01:09'),
(2, 'smtp.gmail.com', 587, 'tls', 1, NULL, NULL, 'your-email@gmail.com', 'Exchange Bridge', NULL, '2025-09-09 12:01:51', '2025-09-09 12:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `file_path` varchar(500) NOT NULL,
  `file_size` bigint(20) NOT NULL,
  `mime_type` varchar(100) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `caption` text DEFAULT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `uploaded_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `filename`, `original_name`, `file_path`, `file_size`, `mime_type`, `file_type`, `caption`, `alt_text`, `uploaded_by`, `created_at`, `updated_at`) VALUES
(2, '1749130885_68419e8518f96.jpeg', 'Exchange-Bridge.jpeg', 'assets/uploads/blog/1749130885_68419e8518f96.jpeg', 197009, 'image/jpeg', 'image', 'Site Cover', '', 1, '2025-06-06 02:41:25', '2025-07-05 01:06:28'),
(3, '6841c1506ea26.png', '6841c1506ea26.png', 'assets/uploads/currencies/6841c1506ea26.png', 29330, 'image/png', 'image', NULL, NULL, 1, '2025-06-06 05:09:52', '2025-06-06 05:09:52'),
(4, '6841dce58a387.jpeg', '6841dce58a387.jpeg', 'assets/uploads/currencies/6841dce58a387.jpeg', 37635, 'image/jpeg', 'image', NULL, NULL, 1, '2025-06-06 07:07:33', '2025-06-06 07:07:33'),
(5, '6841dd2c7efb7.jpeg', '6841dd2c7efb7.jpeg', 'assets/uploads/currencies/6841dd2c7efb7.jpeg', 24480, 'image/jpeg', 'image', NULL, NULL, 1, '2025-06-06 07:08:44', '2025-06-06 07:08:44'),
(6, '6841dd4364192.png', '6841dd4364192.png', 'assets/uploads/currencies/6841dd4364192.png', 34911, 'image/png', 'image', NULL, NULL, 1, '2025-06-06 07:09:07', '2025-06-06 07:09:07'),
(7, '6841ddb3092d7.jpeg', '6841ddb3092d7.jpeg', 'assets/uploads/currencies/6841ddb3092d7.jpeg', 45827, 'image/jpeg', 'image', NULL, NULL, 1, '2025-06-06 07:10:59', '2025-06-06 07:10:59'),
(9, '6841de79b4f18.jpeg', '6841de79b4f18.jpeg', 'assets/uploads/currencies/6841de79b4f18.jpeg', 24210, 'image/jpeg', 'image', NULL, NULL, 1, '2025-06-06 07:14:17', '2025-06-06 07:14:17'),
(10, '6841dead54dcf.png', '6841dead54dcf.png', 'assets/uploads/currencies/6841dead54dcf.png', 137791, 'image/png', 'image', NULL, NULL, 1, '2025-06-06 07:15:09', '2025-06-06 07:15:09'),
(11, '6841df24740e4.jpeg', '6841df24740e4.jpeg', 'assets/uploads/currencies/6841df24740e4.jpeg', 13931, 'image/jpeg', 'image', NULL, NULL, 1, '2025-06-06 07:17:08', '2025-06-06 07:17:08'),
(12, '6841e092832aa.png', '6841e092832aa.png', 'assets/uploads/currencies/6841e092832aa.png', 13874, 'image/png', 'image', NULL, NULL, 1, '2025-06-06 07:23:14', '2025-06-06 07:23:14'),
(13, '6841e0a21868e.png', 'nagad.png', 'assets/uploads/currencies/6841e0a21868e.png', 7909, 'image/png', 'image', 'Nagad Logo', '', 1, '2025-06-06 07:23:30', '2025-07-05 01:04:59'),
(73, '686950d16b87b.jpeg', '686950d16b87b.jpeg', 'assets/uploads/currencies/686950d16b87b.jpeg', 43588, 'image/jpeg', 'image', NULL, NULL, 1, '2025-07-07 05:19:37', '2025-07-07 05:19:37'),
(74, '6869a6e8cf2a2.jpeg', '6869a6e8cf2a2.jpeg', 'assets/uploads/currencies/6869a6e8cf2a2.jpeg', 227678, 'image/jpeg', 'image', NULL, NULL, 1, '2025-07-07 05:19:37', '2025-07-07 05:19:37'),
(75, '6869a714aff63.png', '6869a714aff63.png', 'assets/uploads/currencies/6869a714aff63.png', 8662, 'image/png', 'image', NULL, NULL, 1, '2025-07-07 05:19:37', '2025-07-07 05:19:37'),
(76, '6869a7436faf6.png', '6869a7436faf6.png', 'assets/uploads/currencies/6869a7436faf6.png', 238941, 'image/png', 'image', NULL, NULL, 1, '2025-07-07 05:19:37', '2025-07-07 05:19:37'),
(77, '686aa46f2d2e2.png', '686aa46f2d2e2.png', 'assets/uploads/currencies/686aa46f2d2e2.png', 48550, 'image/png', 'image', NULL, NULL, 1, '2025-07-07 05:29:35', '2025-07-07 05:29:35'),
(78, '686ae517a1e77_1751835927.jpeg', 'Live-Chat-Icon-2.jpeg', 'assets/uploads/media/686ae517a1e77_1751835927.jpeg', 32666, 'image/jpeg', 'image', 'Live Chat Icon', '', 1, '2025-07-07 10:05:27', '2025-07-07 10:08:02'),
(79, '686ae517a2593_1751835927.jpeg', 'Live-Chat-Icon.jpeg', 'assets/uploads/media/686ae517a2593_1751835927.jpeg', 37859, 'image/jpeg', 'image', 'Live-Chat-Icon', '', 1, '2025-07-07 10:05:27', '2025-07-07 10:07:32'),
(80, '686ae517a2bb8_1751835927.png', 'WhatsApp-Icon.png', 'assets/uploads/media/686ae517a2bb8_1751835927.png', 66733, 'image/png', 'image', 'WhatsApp Icon', '', 1, '2025-07-07 10:05:27', '2025-07-07 10:06:57'),
(81, '686ae538b6ee8_1751835960.jpeg', 'Logo.jpeg', 'assets/uploads/media/686ae538b6ee8_1751835960.jpeg', 64179, 'image/jpeg', 'image', '', '', 1, '2025-07-07 10:06:00', '2025-07-07 10:08:20'),
(82, '686ae538b7536_1751835960.png', 'Logo-Transparent.png', 'assets/uploads/media/686ae538b7536_1751835960.png', 161458, 'image/png', 'image', 'Transparent Logo', '', 1, '2025-07-07 10:06:00', '2025-07-07 10:08:49'),
(83, '686ae538b7af6_1751835960.jpeg', 'Transparent-LOGO.jpeg', 'assets/uploads/media/686ae538b7af6_1751835960.jpeg', 33047, 'image/jpeg', 'image', 'Logo', '', 1, '2025-07-07 10:06:00', '2025-07-07 10:09:39'),
(84, '686ae62b33203_1751836203.webp', 'Logo-Large.png', 'assets/uploads/media/686ae62b33203_1751836203.webp', 647256, 'image/webp', 'image', '', '', 1, '2025-07-07 10:10:03', '2025-07-07 10:10:30'),
(85, '686ae66a0a7a0_1751836266.webp', '5F5494B9-7583-4C44-A737-F4792145DA78.webp', 'assets/uploads/media/686ae66a0a7a0_1751836266.webp', 382402, 'image/webp', 'image', NULL, NULL, 1, '2025-07-07 10:11:06', '2025-07-07 10:11:06'),
(86, '686ae66a0b01e_1751836266.webp', 'FAEA1AA8-55F0-4984-ADE9-6C5C2BC7E632.webp', 'assets/uploads/media/686ae66a0b01e_1751836266.webp', 231408, 'image/webp', 'image', NULL, NULL, 1, '2025-07-07 10:11:06', '2025-07-07 10:11:06'),
(87, '686ae66a0b763_1751836266.webp', '4DB588EF-6546-4835-8A6A-C4E433BAC326.webp', 'assets/uploads/media/686ae66a0b763_1751836266.webp', 240482, 'image/webp', 'image', NULL, NULL, 1, '2025-07-07 10:11:06', '2025-07-07 10:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `type` enum('scrolling','popup') NOT NULL,
  `position` int(11) DEFAULT 1,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `type`, `position`, `title`, `content`, `image_path`, `status`, `created_at`, `updated_at`) VALUES
(14, 'scrolling', 1, 'Offer (TEST)', '📣 নতুন অফার! এখন PayPal, Payoneer, Skrill ও Wise থেকে টাকা তুলুন নিরাপদে ও দ্রুত — Exchange Bridge এর মাধ্যমে। 🕒 মাত্র ১৫-৩০ মিনিটেই পেমেন্ট! 🎁 নতুন গ্রাহকদের জন্য ১% বোনাস অফার চলছে! | 📞 সাপোর্ট: 01730250576 | 🌐 ভিজিট করুন: http://exchange-bridge.rf.gd', '', 'active', '2025-06-06 02:47:19', '2025-07-06 09:29:03'),
(15, 'popup', 1, 'Welcome to Exchange Bridge', '<p style=\"text-align: center;\"><strong>👋 Exchange Bridge-এ স্বাগতম!</strong></p><p>\r\n</p><p style=\"text-align: center;\"><strong>বাংলাদেশের ফ্রিল্যান্সার ও অনলাইন আয়ের পথকে আরো সহজ ও নিরাপদ করতে আমরা আছি আপনার পাশে। এখন PayPal, Payoneer, Skrill, Wise থেকে টাকা তুলুন সহজেই — মাত্র ১৫-৩০ মিনিটে!</strong></p><p>\r\n</p><p style=\"text-align: center;\"><strong>💸 নতুন ব্যবহারকারী? উপভোগ করুন ১% বোনাস আপনার প্রথম এক্সচেঞ্জে!</strong></p><p>\r\n</p><p style=\"text-align: center;\"><strong>✅ নিরাপদ | ✅ দ্রুত | ✅ কোন ঝামেলা নেই</strong></p><p>\r\n</p><p style=\"text-align: center;\"><strong>🚀 চলুন, আজই শুরু করুন আপনার এক্সচেঞ্জ যাত্রা!🔗 [http://exchange-bridge.rf.gd]</strong></p>', '', 'inactive', '2025-06-06 02:48:51', '2025-07-05 22:03:05'),
(19, 'scrolling', 3, '', '👋 Exchange Bridge-এ স্বাগতম!\r\n\r\nবাংলাদেশের ফ্রিল্যান্সার ও অনলাইন আয়ের পথকে আরো সহজ ও নিরাপদ করতে আমরা আছি আপনার পাশে। এখন PayPal, Payoneer, Skrill, Wise থেকে টাকা তুলুন সহজেই — মাত্র ১৫-৩০ মিনিটে!\r\n\r\n💸 নতুন ব্যবহারকারী? উপভোগ করুন ১% বোনাস আপনার প্রথম এক্সচেঞ্জে!\r\n\r\n✅ নিরাপদ | ✅ দ্রুত | ✅ কোন ঝামেলা নেই\r\n\r\n🚀 চলুন, আজই শুরু করুন আপনার এক্সচেঞ্জ যাত্রা!🔗 [http://exchange-bridge.rf.gd]', NULL, 'active', '2025-07-05 21:24:29', '2025-07-05 08:24:29'),
(45, 'popup', 1, 'Test image', '<p><img src=\"https://saieed-rahman.rf.gd/EB/assets/uploads/notices/popup_tinymce_1751800777_5576.jpg\"></p>', NULL, 'active', '2025-07-07 00:19:47', '2025-07-07 00:19:47');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_settings`
--

CREATE TABLE `oauth_settings` (
  `id` int(11) NOT NULL,
  `provider` varchar(50) NOT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `client_secret` varchar(255) DEFAULT NULL,
  `redirect_uri` varchar(255) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_settings`
--

INSERT INTO `oauth_settings` (`id`, `provider`, `client_id`, `client_secret`, `redirect_uri`, `enabled`, `created_at`, `updated_at`) VALUES
(1, 'google', '126175981408-6s0tio3d77c2v45orrqkk9t6pbarhir4.apps.googleusercontent.com', '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', NULL, 0, '2025-09-09 12:01:09', '2025-09-09 12:01:09');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` mediumtext DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `slug`, `title`, `content`, `meta_title`, `meta_description`, `meta_keywords`, `featured_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'about', 'About Us', '<h3 data-start=\"205\" data-end=\"226\"><strong data-start=\"209\" data-end=\"226\">আমাদের পরিচয়</strong></h3>\r\n<p data-start=\"228\" data-end=\"672\"><strong data-start=\"228\" data-end=\"247\">Exchange Bridge</strong> হলো বাংলাদেশের অন্যতম উদীয়মান এবং নির্ভরযোগ্য আন্তর্জাতিক পেমেন্ট এক্সচেঞ্জ সেবা প্রদানকারী প্রতিষ্ঠান। আমরা বাংলাদেশী ফ্রিল্যান্সার, রিমোট কর্মী, ডিজিটাল উদ্যোক্তা এবং অনলাইন ব্যবসায়ীদের জন্য এমন একটি প্রযুক্তিনির্ভর সমাধান নিয়ে এসেছি, যার মাধ্যমে তারা PayPal, Payoneer, Skrill, Wise, এবং অন্যান্য আন্তর্জাতিক পেমেন্ট প্ল্যাটফর্ম থেকে খুব সহজেই টাকা স্থানান্তর করতে পারেন বাংলাদেশী মোবাইল ব্যাংকিং বা ব্যাংক অ্যাকাউন্টে।</p>\r\n<p data-start=\"674\" data-end=\"1017\">আমাদের যাত্রা শুরু হয় ২০১৯ সালে। শুরুর থেকেই লক্ষ্য ছিল—বাংলাদেশে আন্তর্জাতিক পেমেন্ট সিস্টেমে সহজতা, স্বচ্ছতা ও দ্রুততা আনা। যেহেতু আমাদের দেশে PayPal-এর মত গুরুত্বপূর্ণ পেমেন্ট গেটওয়ে সরাসরি সাপোর্ট করে না, তাই Exchange Bridge একটি \'ডিজিটাল সেতু\' হিসেবে কাজ করে, যা আন্তর্জাতিক আয়কে রূপান্তর করে দেশের প্রচলিত ব্যাংকিং চ্যানেলে নিয়ে আসে।</p>\r\n<hr data-start=\"1019\" data-end=\"1022\">\r\n<h3 data-start=\"1024\" data-end=\"1043\"><strong data-start=\"1028\" data-end=\"1043\">আমাদের মিশন</strong></h3>\r\n<p data-start=\"1045\" data-end=\"1313\">আমাদের মূল উদ্দেশ্য হলো এমন একটি সেবা প্রদান করা যা সহজ, নিরাপদ এবং সবার জন্য প্রবেশযোগ্য। আমরা চাই যে প্রত্যেক ফ্রিল্যান্সার, যিনি বিশ্ববাজারে কাজ করছেন, তিনি যেন তার কষ্টার্জিত অর্থ অনায়াসে এবং নির্ভয়ে গ্রহণ করতে পারেন—কোনো দীর্ঘ অপেক্ষা বা জটিল প্রক্রিয়া ছাড়াই।</p>\r\n<hr data-start=\"1315\" data-end=\"1318\">\r\n<h3 data-start=\"1320\" data-end=\"1339\"><strong data-start=\"1324\" data-end=\"1339\">আমাদের ভিশন</strong></h3>\r\n<p data-start=\"1341\" data-end=\"1611\">আমরা এমন একটি ডিজিটাল আর্থিক এক্সচেঞ্জ নেটওয়ার্ক গড়ে তুলতে চাই, যা শুধু বাংলাদেশে নয়, আন্তর্জাতিক ক্ষেত্রেও উদাহরণ তৈরি করবে। ভবিষ্যতে আমরা আমাদের সেবাকে মোবাইল অ্যাপ, রেমিট্যান্স সার্ভিস এবং ক্রিপ্টোকারেন্সি এক্সচেঞ্জের মতো নতুন ফিচারের মাধ্যমে আরও বিস্তৃত করতে চাই।</p>\r\n<hr data-start=\"1613\" data-end=\"1616\">\r\n<h3 data-start=\"1618\" data-end=\"1642\"><strong data-start=\"1622\" data-end=\"1642\">আমাদের বৈশিষ্ট্য</strong></h3>\r\n<ul data-start=\"1644\" data-end=\"1909\">\r\n<li data-start=\"1644\" data-end=\"1685\">\r\n<p data-start=\"1646\" data-end=\"1685\">✅ দ্রুততম সময়ে টাকা লেনদেন (৫-৩০ মিনিটে)</p>\r\n</li>\r\n<li data-start=\"1686\" data-end=\"1721\">\r\n<p data-start=\"1688\" data-end=\"1721\">🔒 সর্বোচ্চ নিরাপত্তা ও গোপনীয়তা</p>\r\n</li>\r\n<li data-start=\"1722\" data-end=\"1780\">\r\n<p data-start=\"1724\" data-end=\"1780\">📱 বিকাশ, নগদ, রকেট, ব্যাংক ও উপায়ে টাকা গ্রহণের সুবিধা</p>\r\n</li>\r\n<li data-start=\"1781\" data-end=\"1859\">\r\n<p data-start=\"1783\" data-end=\"1859\">🌍 PayPal, Payoneer, Skrill, Wise সহ বহু আন্তর্জাতিক পেমেন্ট সিস্টেম সাপোর্ট</p>\r\n</li>\r\n<li data-start=\"1860\" data-end=\"1909\">\r\n<p data-start=\"1862\" data-end=\"1909\">🤝 ২৪/৭ দ্বিভাষিক (বাংলা-ইংরেজি) গ্রাহক সহায়তা</p>\r\n</li>\r\n</ul>\r\n<hr data-start=\"1911\" data-end=\"1914\">\r\n<h3 data-start=\"1916\" data-end=\"1950\"><strong data-start=\"1920\" data-end=\"1950\">কেন আমাদের নির্বাচন করবেন?</strong></h3>\r\n<ul data-start=\"1952\" data-end=\"2162\">\r\n<li data-start=\"1952\" data-end=\"1994\">\r\n<p data-start=\"1954\" data-end=\"1994\">কোনো লুকানো ফি নেই – সম্পূর্ণ স্বচ্ছ রেট</p>\r\n</li>\r\n<li data-start=\"1995\" data-end=\"2037\">\r\n<p data-start=\"1997\" data-end=\"2037\">বাংলাদেশের জন্য কাস্টমাইজ করা বিশেষ সেবা</p>\r\n</li>\r\n</ul>\r\n<hr data-start=\"2164\" data-end=\"2167\">\r\n<h3 data-start=\"2169\" data-end=\"2193\"><strong data-start=\"2173\" data-end=\"2193\">যোগাযোগের ঠিকানা</strong></h3>\r\n<p data-start=\"2195\" data-end=\"2441\">🌐 ওয়েবসাইট: <a class=\"\" href=\"http://exchange-bridge.rf.gd/\" target=\"_new\" rel=\"noopener\" data-start=\"2209\" data-end=\"2269\">http://exchange-bridge.rf.gd</a><br data-start=\"2269\" data-end=\"2272\">📞 ফোন: <a href=\"tel:008801730250576\">008801730250576</a>, <a href=\"tel:0097474414725\">0097474414725</a><br data-start=\"2310\" data-end=\"2313\">📧 ইমেইল: <a class=\"cursor-pointer\" rel=\"noopener\" data-start=\"2323\" data-end=\"2349\">paymentbridge.bd@gmail.com</a><br data-start=\"2349\" data-end=\"2352\">💬 লাইভ চ্যাট: ওয়েবসাইটে ২৪/৭ সাপোর্ট<br data-start=\"2390\" data-end=\"2393\">📱 সোশ্যাল মিডিয়া: Facebook, Telegram, WhatsApp</p>', 'About Us - Exchange Bridge', 'বাংলাদেশী ফ্রিল্যান্সারদের জন্য দ্রুত, নিরাপদ ও স্বচ্ছ আন্তর্জাতিক পেমেন্ট এক্সচেঞ্জ সেবা। PayPal, Payoneer, Skrill থেকে টাকা তুলুন সহজে।', '', NULL, 'active', '2025-05-26 08:10:00', '2025-07-04 23:00:43'),
(2, 'privacy', 'Privacy Policy', '<h3 data-start=\"2492\" data-end=\"2534\"><strong data-start=\"2496\" data-end=\"2534\">আপনার গোপনীয়তাই আমাদের অগ্রাধিকার</strong></h3>\r\n<p data-start=\"2536\" data-end=\"2759\">Exchange Bridge-এ, আমরা আপনার ব্যক্তিগত ও আর্থিক তথ্যের নিরাপত্তা এবং গোপনীয়তাকে অত্যন্ত গুরুত্ব সহকারে দেখি। আমরা বিশ্বাস করি, একটি নিরাপদ পেমেন্ট ইকোসিস্টেম গড়ে তুলতে হলে ব্যবহারকারীর তথ্য সুরক্ষা নিশ্চিত করা অপরিহার্য।</p>\r\n<hr data-start=\"2761\" data-end=\"2764\">\r\n<h3 data-start=\"2766\" data-end=\"2803\"><strong data-start=\"2770\" data-end=\"2803\">আমরা কোন কোন তথ্য সংগ্রহ করি?</strong></h3>\r\n<p data-start=\"2805\" data-end=\"2921\">আপনি আমাদের ওয়েবসাইটে রেজিস্ট্রেশন করার সময় বা এক্সচেঞ্জ অর্ডার প্লেস করার সময়, আমরা যেসব তথ্য সংগ্রহ করি তা হলো:</p>\r\n<ul data-start=\"2923\" data-end=\"3172\">\r\n<li data-start=\"2923\" data-end=\"2951\">\r\n<p data-start=\"2925\" data-end=\"2951\">আপনার নাম ও ইমেইল ঠিকানা</p>\r\n</li>\r\n<li data-start=\"2952\" data-end=\"2968\">\r\n<p data-start=\"2954\" data-end=\"2968\">মোবাইল নম্বর</p>\r\n</li>\r\n<li data-start=\"2969\" data-end=\"3007\">\r\n<p data-start=\"2971\" data-end=\"3007\">জাতীয় পরিচয়পত্র (NID) / পাসপোর্ট</p>\r\n</li>\r\n<li data-start=\"3008\" data-end=\"3073\">\r\n<p data-start=\"3010\" data-end=\"3073\">পেমেন্ট অ্যাকাউন্টের তথ্য (PayPal/Payoneer/Skrill ID ইত্যাদি)</p>\r\n</li>\r\n<li data-start=\"3074\" data-end=\"3127\">\r\n<p data-start=\"3076\" data-end=\"3127\">আপনার মোবাইল ব্যাংকিং বা ব্যাংক অ্যাকাউন্টের তথ্য</p>\r\n</li>\r\n<li data-start=\"3128\" data-end=\"3172\">\r\n<p data-start=\"3130\" data-end=\"3172\">লেনদেন সংক্রান্ত ইতিহাস ও আইপি অ্যাড্রেস</p>\r\n</li>\r\n</ul>\r\n<hr data-start=\"3174\" data-end=\"3177\">\r\n<h3 data-start=\"3179\" data-end=\"3210\"><strong data-start=\"3183\" data-end=\"3210\">তথ্য ব্যবহারের উদ্দেশ্য</strong></h3>\r\n<p data-start=\"3212\" data-end=\"3270\">আমরা আপনার তথ্য ব্যবহার করি শুধুমাত্র নিচের কাজগুলোর জন্য:</p>\r\n<ul data-start=\"3272\" data-end=\"3508\">\r\n<li data-start=\"3272\" data-end=\"3304\">\r\n<p data-start=\"3274\" data-end=\"3304\">আপনার অ্যাকাউন্ট ভেরিফাই করা</p>\r\n</li>\r\n<li data-start=\"3305\" data-end=\"3337\">\r\n<p data-start=\"3307\" data-end=\"3337\">এক্সচেঞ্জ লেনদেন সম্পন্ন করা</p>\r\n</li>\r\n<li data-start=\"3338\" data-end=\"3379\">\r\n<p data-start=\"3340\" data-end=\"3379\">নিরাপত্তা নিশ্চিত করা ও জালিয়াতি রোধ</p>\r\n</li>\r\n<li data-start=\"3380\" data-end=\"3424\">\r\n<p data-start=\"3382\" data-end=\"3424\">ট্যাক্স রিপোর্ট প্রস্তুত করা (প্রয়োজনে)</p>\r\n</li>\r\n<li data-start=\"3425\" data-end=\"3460\">\r\n<p data-start=\"3427\" data-end=\"3460\">গ্রাহক সাপোর্ট ও যোগাযোগের জন্য</p>\r\n</li>\r\n<li data-start=\"3461\" data-end=\"3508\">\r\n<p data-start=\"3463\" data-end=\"3508\">আমাদের সেবার উন্নয়নের জন্য ডেটা বিশ্লেষণ করা</p>\r\n</li>\r\n</ul>\r\n<hr data-start=\"3510\" data-end=\"3513\">\r\n<h3 data-start=\"3515\" data-end=\"3554\"><strong data-start=\"3519\" data-end=\"3554\">তৃতীয় পক্ষের সঙ্গে তথ্য শেয়ার</strong></h3>\r\n<p data-start=\"3556\" data-end=\"3724\">আমরা আপনার কোনো ব্যক্তিগত তথ্য বিক্রি, লিজ বা তৃতীয় পক্ষের সঙ্গে শেয়ার করি না, যদি না তা আইনগতভাবে বাধ্যতামূলক হয় (যেমন আদালতের আদেশ বা বাংলাদেশ ব্যাংকের নির্দেশনা)।</p>\r\n<hr data-start=\"3726\" data-end=\"3729\">\r\n<h3 data-start=\"3731\" data-end=\"3757\"><strong data-start=\"3735\" data-end=\"3757\">নিরাপত্তা ব্যবস্থা</strong></h3>\r\n<p data-start=\"3759\" data-end=\"3825\">আমরা আপনার তথ্য রক্ষার জন্য নিচের নিরাপত্তা প্রযুক্তি ব্যবহার করি:</p>\r\n<ul data-start=\"3827\" data-end=\"4128\">\r\n<li data-start=\"3827\" data-end=\"3946\">\r\n<p data-start=\"3829\" data-end=\"3946\">✅ <strong data-start=\"3831\" data-end=\"3858\">SSL এনক্রিপশন (256-bit)</strong>: ওয়েবসাইট ও লেনদেনের তথ্য এনক্রিপ্ট করা হয় যাতে কোনো তৃতীয় পক্ষ তথ্য পড়তে না পারে</p>\r\n</li>\r\n<li data-start=\"3947\" data-end=\"4036\">\r\n<p data-start=\"3949\" data-end=\"4036\">✅ <strong data-start=\"3951\" data-end=\"3986\">Two-Factor Authentication (2FA)</strong>: OTP ছাড়া কেউ আপনার অ্যাকাউন্টে ঢুকতে পারবে না</p>\r\n</li>\r\n<li data-start=\"4037\" data-end=\"4128\">\r\n<p data-start=\"4039\" data-end=\"4128\">✅ <strong data-start=\"4041\" data-end=\"4071\">AI-Powered Fraud Detection</strong>: সন্দেহজনক লেনদেন স্বয়ংক্রিয়ভাবে শনাক্ত ও ব্লক করা হয়</p>\r\n</li>\r\n</ul>\r\n<hr data-start=\"4130\" data-end=\"4133\">\r\n<h3 data-start=\"4135\" data-end=\"4159\"><strong data-start=\"4139\" data-end=\"4159\">আপনার অধিকারসমূহ</strong></h3>\r\n<ul data-start=\"4161\" data-end=\"4336\">\r\n<li data-start=\"4161\" data-end=\"4208\">\r\n<p data-start=\"4163\" data-end=\"4208\">আপনার নিজস্ব তথ্য যাচাই, আপডেট বা মুছতে পারেন</p>\r\n</li>\r\n<li data-start=\"4209\" data-end=\"4272\">\r\n<p data-start=\"4211\" data-end=\"4272\">যেকোনো সময় আমাদের থেকে আপনার তথ্য সরানোর অনুরোধ জানাতে পারেন</p>\r\n</li>\r\n<li data-start=\"4273\" data-end=\"4336\">\r\n<p data-start=\"4275\" data-end=\"4336\">আপনার তথ্য আমরা কীভাবে ব্যবহার করছি, তার ব্যাখ্যা চাইতে পারেন</p>\r\n</li>\r\n</ul>\r\n<hr data-start=\"4338\" data-end=\"4341\">\r\n<h3 data-start=\"4343\" data-end=\"4365\"><strong data-start=\"4347\" data-end=\"4365\">কুকিজ নীতিমালা</strong></h3>\r\n<p data-start=\"4367\" data-end=\"4510\">আমাদের ওয়েবসাইটে কুকিজ ব্যবহৃত হয় যাতে ব্যবহারকারীর অভিজ্ঞতা আরও উন্নত করা যায়। আপনি চাইলে ব্রাউজার সেটিংস থেকে কুকিজ নিষ্ক্রিয় করতে পারেন।</p>\r\n<hr data-start=\"4512\" data-end=\"4515\">\r\n<h3 data-start=\"4517\" data-end=\"4541\"><strong data-start=\"4521\" data-end=\"4541\">পরিবর্তন ও আপডেট</strong></h3>\r\n<p data-start=\"4543\" data-end=\"4649\">আমরা সময়ে সময়ে এই প্রাইভেসি পলিসিতে পরিবর্তন আনতে পারি। যেকোনো পরিবর্তন ওয়েবসাইটে আপডেট করে জানানো হবে।</p>\r\n<hr data-start=\"4651\" data-end=\"4654\">\r\n<h3 data-start=\"4656\" data-end=\"4676\"><strong data-start=\"4660\" data-end=\"4676\"><img src=\"data:image/webp;base64,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\">যোগাযোগ করুন</strong></h3>\r\n<p data-start=\"4678\" data-end=\"4796\">প্রাইভেসি সংক্রান্ত কোনো প্রশ্ন বা উদ্বেগ থাকলে আমাদের ইমেইলে যোগাযোগ করুন:<br data-start=\"4753\" data-end=\"4756\">📧 <strong data-start=\"4759\" data-end=\"4769\">Email:</strong> <a class=\"cursor-pointer\" rel=\"noopener\" data-start=\"4770\" data-end=\"4796\">paymentbridge.bd@gmail.com</a></p>', 'Privacy Policy - Exchange Bridge', 'আপনার ব্যক্তিগত ও আর্থিক তথ্যের সর্বোচ্চ নিরাপত্তা নিশ্চিত করি। Exchange Bridge এর প্রাইভেসি পলিসি জানুন এবং আমাদের ডেটা ব্যবহারের নিয়ম বুঝুন।', '', NULL, 'active', '2025-05-26 08:10:00', '2025-07-07 00:36:45'),
(3, 'faq', 'Frequently Asked Questions', '<div class=\"space-y-6\"><div><h3 class=\"text-lg font-semibold\">What is Exchange Bridge?</h3><p>আমরা একটি প্ল্যাটফর্ম যা আপনাকে বিভিন্ন মুদ্রা এবং পেমেন্ট পদ্ধতি দ্রুত এবং নিরাপদে এক্সচেঞ্জ করার সুবিধা দিয়ে থাকি।</p></div><div><h3 class=\"text-lg font-semibold\">How long does an exchange take?</h3><p>পেমেন্ট নিশ্চিতকরণের পর বেশিরভাগ এক্সচেঞ্জ অর্ডার ৫-৩০ মিনিটের মধ্যে সম্পন্ন হয়।</p></div><div><h3 class=\"text-lg font-semibold\">What are your fees?</h3><p>আমাদের ফি এক্সচেঞ্জ রেটের মধ্যে অন্তর্ভুক্ত। প্রদর্শিত এক্সচেঞ্জ রেটের উপর আমরা কোনো অতিরিক্ত ফি নেই না।</p></div><div><h3 class=\"text-lg font-semibold\">How do I track my exchange?</h3><p>এক্সচেঞ্জ অর্ডার দেওয়ার পর, আপনি একটি ইউনিক রেফারেন্স আইডি পাবেন। আপনি এই আইডি ব্যবহার করে আপনার এক্সচেঞ্জের অবস্থা ট্র্যাক করতে পারবেন।</p></div><div><h3 class=\"text-lg font-semibold\">How can I contact support?</h3><p>আপনি হোয়াটসঅ্যাপে +974-66489944 নম্বরে অথবা info@exchangebridge.com ইমেইলে আমাদের সাপোর্ট টিমের সাথে যোগাযোগ করতে পারেন।</p></div></div>', 'FAQ - Exchange Bridge', 'Frequently asked questions about Exchange Bridge services, processes, and policies.', NULL, NULL, 'active', '2025-05-26 08:10:00', '2025-07-04 22:46:06'),
(4, 'terms', 'Terms and Conditions', '<p data-start=\"219\" data-end=\"368\"><strong data-start=\"219\" data-end=\"237\">কার্যকর তারিখ:</strong> ১ জুলাই ২০২৫<br data-start=\"250\" data-end=\"253\"><strong data-start=\"253\" data-end=\"274\">প্রতিষ্ঠানের নাম:</strong> Exchange Bridge<br data-start=\"290\" data-end=\"293\"><strong data-start=\"293\" data-end=\"307\">ওয়েবসাইট:</strong> <a class=\"\" href=\"http://exchange-bridge.rf.gd/\" target=\"_new\" rel=\"noopener\" data-start=\"308\" data-end=\"368\">http://exchange-bridge.rf.gd</a></p>\r\n<p data-start=\"370\" data-end=\"593\">এই ওয়েবসাইট এবং এর পরিষেবাগুলি ব্যবহার করার মাধ্যমে আপনি নিচের শর্তাবলি পড়ে, বুঝে এবং গ্রহণ করেছেন বলে গণ্য করা হবে। যদি আপনি এই শর্তাবলির কোনো অংশের সাথে একমত না হন, তাহলে অনুগ্রহ করে আমাদের সেবা ব্যবহার থেকে বিরত থাকুন।</p>\r\n<hr data-start=\"595\" data-end=\"598\">\r\n<h3 data-start=\"600\" data-end=\"629\"> </h3>\r\n<h3 data-start=\"600\" data-end=\"629\"><br><br>১. <strong data-start=\"607\" data-end=\"629\">সেবার গ্রহণযোগ্যতা</strong></h3>\r\n<p data-start=\"631\" data-end=\"675\">আমাদের সেবা ব্যবহার করার জন্য আপনাকে অবশ্যই:</p>\r\n<ul data-start=\"677\" data-end=\"934\">\r\n<li data-start=\"677\" data-end=\"721\">\r\n<p data-start=\"679\" data-end=\"721\">ন্যূনতম ১৮ বছর বা তার বেশি বয়সী হতে হবে</p>\r\n</li>\r\n<li data-start=\"722\" data-end=\"780\">\r\n<p data-start=\"724\" data-end=\"780\">একটি বৈধ জাতীয় পরিচয়পত্র (NID) বা পাসপোর্ট থাকতে হবে</p>\r\n</li>\r\n<li data-start=\"781\" data-end=\"871\">\r\n<p data-start=\"783\" data-end=\"871\">নিজের নামে থাকা পেমেন্ট অ্যাকাউন্ট ব্যবহার করতে হবে (PayPal, Payoneer, Skrill ইত্যাদি)</p>\r\n</li>\r\n<li data-start=\"872\" data-end=\"934\">\r\n<p data-start=\"874\" data-end=\"934\">বাংলাদেশের নাগরিক বা বৈধভাবে অবস্থানরত ব্যবহারকারী হতে হবে</p>\r\n</li>\r\n</ul>\r\n<p> </p>\r\n<hr data-start=\"936\" data-end=\"939\">\r\n<h3 data-start=\"941\" data-end=\"963\">২. <strong data-start=\"948\" data-end=\"963\">সেবার বিবরণ</strong></h3>\r\n<p data-start=\"965\" data-end=\"1174\">Exchange Bridge হলো একটি অনলাইন পেমেন্ট এক্সচেঞ্জ সেবা, যা PayPal, Payoneer, Skrill, Wise ও অন্যান্য আন্তর্জাতিক প্ল্যাটফর্ম থেকে বাংলাদেশী টাকায় অর্থ রূপান্তরের সুযোগ দেয়। টাকা তোলা যায় নিম্নলিখিত মাধ্যমে:</p>\r\n<ul data-start=\"1176\" data-end=\"1266\">\r\n<li data-start=\"1176\" data-end=\"1193\">\r\n<p data-start=\"1178\" data-end=\"1193\">বিকাশ (bKash)</p>\r\n</li>\r\n<li data-start=\"1194\" data-end=\"1209\">\r\n<p data-start=\"1196\" data-end=\"1209\">নগদ (Nagad)</p>\r\n</li>\r\n<li data-start=\"1210\" data-end=\"1227\">\r\n<p data-start=\"1212\" data-end=\"1227\">রকেট (Rocket)</p>\r\n</li>\r\n<li data-start=\"1228\" data-end=\"1244\">\r\n<p data-start=\"1230\" data-end=\"1244\">উপায় (Upay)</p>\r\n</li>\r\n<li data-start=\"1245\" data-end=\"1266\">\r\n<p data-start=\"1247\" data-end=\"1266\">ব্যাংক ট্রান্সফার</p>\r\n</li>\r\n</ul>\r\n<p data-start=\"1268\" data-end=\"1326\">প্রত্যেকটি লেনদেন যাচাই ও নিশ্চিতকরণের পর সম্পন্ন করা হয়।</p>\r\n<p> </p>\r\n<hr data-start=\"1328\" data-end=\"1331\">\r\n<h3 data-start=\"1333\" data-end=\"1361\">৩. <strong data-start=\"1340\" data-end=\"1361\">লেনদেনের শর্তাবলি</strong></h3>\r\n<ul data-start=\"1363\" data-end=\"1680\">\r\n<li data-start=\"1363\" data-end=\"1429\">\r\n<p data-start=\"1365\" data-end=\"1429\">এক্সচেঞ্জ অর্ডার প্লেস করার পর তা যাচাই ও প্রক্রিয়া শুরু হয়।</p>\r\n</li>\r\n<li data-start=\"1430\" data-end=\"1531\">\r\n<p data-start=\"1432\" data-end=\"1531\">পেমেন্ট আমাদের নির্দিষ্ট একাউন্টে আসার পর, ১৫–৩০ মিনিটের মধ্যে স্থানীয় একাউন্টে টাকা পাঠানো হয়।</p>\r\n</li>\r\n<li data-start=\"1532\" data-end=\"1611\">\r\n<p data-start=\"1534\" data-end=\"1611\">আপনি ভুল তথ্য দিলে বা যাচাইকরণে ব্যর্থ হলে লেনদেন বিলম্ব বা বাতিল হতে পারে।</p>\r\n</li>\r\n<li data-start=\"1612\" data-end=\"1680\">\r\n<p data-start=\"1614\" data-end=\"1680\">কোনো সন্দেহজনক লেনদেন সনাক্ত হলে আমরা তা ব্লক বা দেরি করতে পারি।</p>\r\n</li>\r\n</ul>\r\n<hr data-start=\"1682\" data-end=\"1685\">\r\n<h3 data-start=\"1687\" data-end=\"1711\">৪. <strong data-start=\"1694\" data-end=\"1711\">ফি ও রেট নীতি</strong></h3>\r\n<ul data-start=\"1713\" data-end=\"1891\">\r\n<li data-start=\"1713\" data-end=\"1778\">\r\n<p data-start=\"1715\" data-end=\"1778\">আমাদের রেট প্রতিদিন আন্তর্জাতিক বাজার অনুযায়ী আপডেট করা হয়।</p>\r\n</li>\r\n<li data-start=\"1779\" data-end=\"1834\">\r\n<p data-start=\"1781\" data-end=\"1834\">আমরা সবসময় স্বচ্ছতা বজায় রাখি—কোনো লুকানো ফি নেই।</p>\r\n</li>\r\n<li data-start=\"1835\" data-end=\"1891\">\r\n<p data-start=\"1837\" data-end=\"1891\">ওয়েবসাইটে দেখানো রেট অনুযায়ীই টাকা প্রদান করা হয়।</p>\r\n</li>\r\n</ul>\r\n<hr data-start=\"1893\" data-end=\"1896\">\r\n<h3 data-start=\"1898\" data-end=\"1930\">৫. <strong data-start=\"1905\" data-end=\"1930\">ব্যবহারকারীর দায়িত্ব</strong></h3>\r\n<ul data-start=\"1932\" data-end=\"2133\">\r\n<li data-start=\"1932\" data-end=\"1999\">\r\n<p data-start=\"1934\" data-end=\"1999\">আপনি যে অ্যাকাউন্ট ব্যবহার করছেন তা অবশ্যই আপনার নিজের হতে হবে।</p>\r\n</li>\r\n<li data-start=\"2000\" data-end=\"2055\">\r\n<p data-start=\"2002\" data-end=\"2055\">আপনার অ্যাকাউন্টের তথ্য নিরাপদ রাখা আপনার দায়িত্ব।</p>\r\n</li>\r\n<li data-start=\"2056\" data-end=\"2133\">\r\n<p data-start=\"2058\" data-end=\"2133\">আপনি আমাদের সাইটে ভুল বা মিথ্যা তথ্য দিলে, তা আইনি অপরাধ হিসেবে গণ্য হবে।</p>\r\n</li>\r\n</ul>\r\n<hr data-start=\"2135\" data-end=\"2138\">\r\n<h3 data-start=\"2140\" data-end=\"2174\">৬. <strong data-start=\"2147\" data-end=\"2174\">বাতিলকরণ ও রিফান্ড নীতি</strong></h3>\r\n<ul data-start=\"2176\" data-end=\"2417\">\r\n<li data-start=\"2176\" data-end=\"2241\">\r\n<p data-start=\"2178\" data-end=\"2241\">পেমেন্ট কনফার্ম হওয়ার আগে যেকোনো সময় অর্ডার বাতিল করা যায়।</p>\r\n</li>\r\n<li data-start=\"2242\" data-end=\"2337\">\r\n<p data-start=\"2244\" data-end=\"2337\">একবার অর্থ প্রদান সম্পন্ন হলে তা ফেরতযোগ্য নয়, যদি না সেটা আমাদের ত্রুটির কারণে হয়ে থাকে।</p>\r\n</li>\r\n<li data-start=\"2338\" data-end=\"2417\">\r\n<p data-start=\"2340\" data-end=\"2417\">রিফান্ড কেবল যাচাইকৃত পরিস্থিতিতে এবং নির্দিষ্ট প্রমাণ সাপেক্ষে দেওয়া হয়।</p>\r\n</li>\r\n</ul>\r\n<hr data-start=\"2419\" data-end=\"2422\">\r\n<h3 data-start=\"2424\" data-end=\"2456\">৭. <strong data-start=\"2431\" data-end=\"2456\">নিরাপত্তা ও গোপনীয়তা</strong></h3>\r\n<ul data-start=\"2458\" data-end=\"2709\">\r\n<li data-start=\"2458\" data-end=\"2537\">\r\n<p data-start=\"2460\" data-end=\"2537\">আমরা 256-bit SSL এনক্রিপশন এবং 2FA ব্যবহার করি যাতে আপনার তথ্য নিরাপদ থাকে।</p>\r\n</li>\r\n<li data-start=\"2538\" data-end=\"2633\">\r\n<p data-start=\"2540\" data-end=\"2633\">আপনার ব্যক্তিগত তথ্য কখনোই তৃতীয় পক্ষের সাথে শেয়ার করা হয় না (আইনগত বাধ্যবাধকতা ব্যতীত)।</p>\r\n</li>\r\n<li data-start=\"2634\" data-end=\"2709\">\r\n<p data-start=\"2636\" data-end=\"2709\">আমাদের AI সিস্টেম সন্দেহজনক কার্যকলাপ শনাক্ত করে এবং প্রতিরোধে কাজ করে।</p>\r\n</li>\r\n</ul>\r\n<hr data-start=\"2711\" data-end=\"2714\">\r\n<h3 data-start=\"2716\" data-end=\"2749\">৮. <strong data-start=\"2723\" data-end=\"2749\">সেবার পরিবর্তন ও আপডেট</strong></h3>\r\n<p data-start=\"2751\" data-end=\"2896\">আমরা সময়ে সময়ে আমাদের সেবা, রেট, এবং এই শর্তাবলিতে পরিবর্তন আনতে পারি। যেকোনো পরিবর্তন আমাদের ওয়েবসাইটে প্রকাশ করা হবে এবং তা কার্যকর ধরা হবে।</p>\r\n<hr data-start=\"2898\" data-end=\"2901\">\r\n<h3 data-start=\"2903\" data-end=\"2937\">৯. <strong data-start=\"2910\" data-end=\"2937\">দায়মুক্তি (Disclaimer)</strong></h3>\r\n<ul data-start=\"2939\" data-end=\"3136\">\r\n<li data-start=\"2939\" data-end=\"3082\">\r\n<p data-start=\"2941\" data-end=\"3082\">আমরা সর্বোচ্চ চেষ্টা করি নির্ভুল ও নিরবিচারে সেবা প্রদানের জন্য, তবে প্রযুক্তিগত বা তৃতীয় পক্ষের ত্রুটির জন্য কোনো ক্ষতির দায় আমাদের নয়।</p>\r\n</li>\r\n<li data-start=\"3083\" data-end=\"3136\">\r\n<p data-start=\"3085\" data-end=\"3136\">ব্যবহারকারী নিজ দায়িত্বে আমাদের সেবা গ্রহণ করেন।</p>\r\n</li>\r\n</ul>\r\n<hr data-start=\"3138\" data-end=\"3141\">\r\n<h3 data-start=\"3143\" data-end=\"3171\">১০. <strong data-start=\"3151\" data-end=\"3171\">আইনি বাধ্যবাধকতা</strong></h3>\r\n<p data-start=\"3173\" data-end=\"3383\">আমাদের সকল কার্যক্রম বাংলাদেশ সরকারের আইন এবং বাংলাদেশ ব্যাংকের প্রযোজ্য নিয়ম-কানুন অনুযায়ী পরিচালিত হয়। আপনি আমাদের সেবা ব্যবহার করে সম্মত হচ্ছেন যে, কোনো ধরণের অবৈধ লেনদেনের জন্য Exchange Bridge দায়ী নয়।</p>\r\n<hr data-start=\"3385\" data-end=\"3388\">\r\n<h3 data-start=\"3390\" data-end=\"3409\">১১. <strong data-start=\"3398\" data-end=\"3409\">যোগাযোগ</strong></h3>\r\n<p data-start=\"3411\" data-end=\"3510\">আপনার যদি এই শর্তাবলি সম্পর্কে কোনো প্রশ্ন থাকে, তাহলে নিচের মাধ্যমগুলোতে আমাদের সাথে যোগাযোগ করুন:</p>\r\n<p data-start=\"3512\" data-end=\"3651\">📧 ইমেইল: <a class=\"cursor-pointer\" rel=\"noopener\" data-start=\"3522\" data-end=\"3548\">paymentbridge.bd@gmail.com</a><br data-start=\"3548\" data-end=\"3551\">📞 ফোন: <a href=\"tel:008801730250576\">008801730250576</a><br data-start=\"3574\" data-end=\"3577\">🌐 ওয়েবসাইট: <a class=\"\" href=\"http://exchange-bridge.rf.gd/\" target=\"_new\" rel=\"noopener\" data-start=\"3591\" data-end=\"3651\">http://exchange-bridge.rf.gd</a></p>\r\n<hr data-start=\"3653\" data-end=\"3656\">\r\n<p data-start=\"3658\" data-end=\"3729\"><strong data-start=\"3658\" data-end=\"3729\">Exchange Bridge – আপনার আন্তর্জাতিক আয়ের নিরাপদ, সহজ ও দ্রুত সেতু।</strong></p>', 'Terms and Conditions - Exchange Bridge', 'Read our terms and conditions to understand the rules and regulations for using our services.', '', NULL, 'active', '2025-07-04 05:10:54', '2025-07-07 02:03:37'),
(5, 'contact', 'Contact Us', 'We would love to hear from you! Please feel free to contact us using the form or the contact details below.', 'Contact Us - Exchange Bridge', 'Get in touch with us for any questions or support. We are here to help you.', NULL, NULL, 'active', '2025-07-04 05:23:54', '2025-07-04 05:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(100) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rate_limits`
--

CREATE TABLE `rate_limits` (
  `id` int(11) NOT NULL,
  `rate_key` varchar(64) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `action` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rate_limits`
--

INSERT INTO `rate_limits` (`id`, `rate_key`, `ip_address`, `action`, `created_at`) VALUES
(742, '6818f7c5d7ca55c71d3ec0ccb7ea260c62b257a39bad5850959cd8e720d64ba4', '37.186.40.96', 'homepage_visit', '2025-11-11 09:22:57'),
(743, '298cadb5b187a4460914ac7e27eb02b0851eec3ff83a21edb98cb0ec6745b45d', '37.186.40.96', 'exchange_access_37.186.40.96', '2025-11-11 09:22:57'),
(744, '6818f7c5d7ca55c71d3ec0ccb7ea260c62b257a39bad5850959cd8e720d64ba4', '37.186.40.96', 'homepage_visit', '2025-11-11 09:25:20'),
(745, '298cadb5b187a4460914ac7e27eb02b0851eec3ff83a21edb98cb0ec6745b45d', '37.186.40.96', 'exchange_access_37.186.40.96', '2025-11-11 09:25:20'),
(746, '87fda9aa05812f970d35fdcc63f2660dd1f7bc535e74a65d2cf2064389920bb7', '37.186.40.96', 'homepage_visit', '2025-11-11 09:28:53'),
(747, 'a86c70fd64d7651b7e6b5c5c6229de1c01fd98a17107dc2e0abe303ba140e984', '37.186.40.96', 'exchange_access_37.186.40.96', '2025-11-11 09:28:53'),
(748, '6818f7c5d7ca55c71d3ec0ccb7ea260c62b257a39bad5850959cd8e720d64ba4', '37.186.40.96', 'homepage_visit', '2025-11-11 10:04:23'),
(749, '298cadb5b187a4460914ac7e27eb02b0851eec3ff83a21edb98cb0ec6745b45d', '37.186.40.96', 'exchange_access_37.186.40.96', '2025-11-11 10:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `reserves`
--

CREATE TABLE `reserves` (
  `id` int(11) NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `amount` decimal(20,8) NOT NULL,
  `min_amount` decimal(20,8) NOT NULL DEFAULT 0.00000000,
  `max_amount` decimal(20,8) NOT NULL DEFAULT 0.00000000,
  `auto_update` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reserves`
--

INSERT INTO `reserves` (`id`, `currency_code`, `amount`, `min_amount`, `max_amount`, `auto_update`, `created_at`, `updated_at`) VALUES
(1, 'BDT', '5000000.00000000', '500000.00000000', '10000000.00000000', 1, '2025-05-26 08:10:00', '2025-06-04 05:08:04'),
(2, 'USD', '50000.00000000', '5000.00000000', '100000.00000000', 1, '2025-05-26 08:10:00', '2025-06-04 05:08:04'),
(3, 'BTC', '53939.00000000', '0.25000000', '5.00000000', 1, '2025-05-26 08:10:00', '2025-06-04 05:21:03'),
(4, 'PM', '30000.00000000', '3000.00000000', '60000.00000000', 1, '2025-05-26 08:10:00', '2025-06-04 05:08:04'),
(5, 'BD', '500000.00000000', '50.00000000', '50000.00000000', 1, '2025-06-04 05:09:15', '2025-06-04 05:09:15'),
(6, 'Usdt', '600000.00000000', '5.00000000', '500.00000000', 1, '2025-06-04 05:21:29', '2025-06-04 05:21:29'),
(8, 'Nagad', '50000.00000000', '100.00000000', '10000.00000000', 1, '2025-07-03 16:19:51', '2025-07-03 16:19:51'),
(9, 'Paypal', '500.00000000', '5.00000000', '100.00000000', 1, '2025-07-03 16:20:15', '2025-07-03 16:20:15');

-- --------------------------------------------------------

--
-- Table structure for table `security_logs`
--

CREATE TABLE `security_logs` (
  `id` int(11) NOT NULL,
  `event_type` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `security_logs`
--

INSERT INTO `security_logs` (`id`, `event_type`, `description`, `ip_address`, `user_agent`, `user_id`, `created_at`) VALUES
(25, 'TRANSACTION_TRACK_ATTEMPT', 'Reference ID tracking attempt: EB-25070804', '66.249.66.197', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.7390.107 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', NULL, '2025-10-24 02:12:55'),
(26, 'TRANSACTION_TRACK_ATTEMPT', 'Reference ID tracking attempt: EB-25072601', '66.249.66.194', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.7390.122 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', NULL, '2025-11-07 02:37:26'),
(27, 'TRANSACTION_TRACK_ATTEMPT', 'Reference ID tracking attempt: EB-25072601', '66.249.66.196', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.7390.122 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', NULL, '2025-11-07 08:08:45'),
(28, 'TRANSACTION_TRACK_ATTEMPT', 'Reference ID tracking attempt: EB-25072601', '66.249.66.193', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.7390.122 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', NULL, '2025-11-09 07:12:47'),
(29, 'TRANSACTION_TRACK_ATTEMPT', 'Reference ID tracking attempt: EB-25072601', '66.249.66.71', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.7390.122 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', NULL, '2025-11-09 19:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Exchange Bridge', '2025-07-21 22:45:42', '2025-07-22 14:26:34'),
(2, 'site_url', 'http://demo.exchange-bridge.rf.gd', '2025-07-21 22:45:42', '2025-07-21 22:45:42'),
(3, 'timezone', 'Asia/Dhaka', '2025-07-21 22:45:42', '2025-07-21 22:45:42'),
(4, 'installation_date', '2025-07-21 18:45:42', '2025-07-21 22:45:42', '2025-07-21 22:45:42'),
(5, 'installation_version', '1.0.0', '2025-07-21 22:45:42', '2025-07-21 22:45:42'),
(6, 'license_key', 'EB-S65MG-V84H5-QQNDF-DDAHC', '2025-07-21 22:45:42', '2025-07-21 22:45:42'),
(7, 'license_domain', 'demo.exchange-bridge.rf.gd', '2025-07-21 22:45:42', '2025-07-21 22:45:42'),
(8, 'database_version', '11.4.7-MariaDB', '2025-07-21 22:45:42', '2025-07-21 22:45:42'),
(9, 'config_version', '1.0.0', '2025-07-21 22:45:42', '2025-07-21 22:45:42'),
(10, 'admin_email', 'info.saidur_bd@aol.com', '2025-07-21 22:45:42', '2025-07-21 22:45:42'),
(85, 'bing_site_verification', '', '2025-07-04 07:08:54', '2025-07-04 07:08:54'),
(86, 'yandex_site_verification', '', '2025-07-04 07:08:54', '2025-07-04 07:08:54'),
(87, 'structured_data_enabled', '1', '2025-07-04 07:08:54', '2025-07-04 07:08:54'),
(88, 'sitemap_enabled', '1', '2025-07-04 07:08:54', '2025-07-04 07:08:54'),
(89, 'robots_txt_enabled', '1', '2025-07-04 07:08:54', '2025-07-04 07:08:54'),
(90, 'site_logo_text', 'Exchange Bridge', '2025-07-04 07:08:54', '2025-07-22 14:26:34'),
(91, 'site_author', '', '2025-07-04 07:08:54', '2025-07-04 07:08:54'),
(92, 'site_language', 'en', '2025-07-04 07:08:54', '2025-07-04 07:08:54'),
(93, 'site_region', 'US', '2025-07-04 07:08:54', '2025-07-04 07:08:54'),
(94, 'business_type', 'FinancialService', '2025-07-04 07:08:54', '2025-07-04 07:08:54'),
(95, 'address_street', '', '2025-07-04 07:08:54', '2025-07-04 07:08:54'),
(96, 'address_city', '', '2025-07-04 07:08:54', '2025-07-04 07:08:54'),
(97, 'address_state', '', '2025-07-04 07:08:54', '2025-07-04 07:08:54'),
(98, 'address_country', '', '2025-07-04 07:08:54', '2025-07-04 07:08:54'),
(99, 'address_postal', '', '2025-07-04 07:08:54', '2025-07-04 07:08:54'),
(100, 'social_facebook', '', '2025-07-04 07:08:54', '2025-07-22 14:26:34'),
(101, 'social_twitter', '', '2025-07-04 07:08:54', '2025-07-22 14:26:34'),
(102, 'social_instagram', '', '2025-07-04 07:08:54', '2025-07-22 14:26:34'),
(103, 'social_linkedin', '', '2025-07-04 07:08:54', '2025-07-22 14:26:34'),
(104, 'breadcrumbs_enabled', '1', '2025-07-04 07:08:54', '2025-07-04 07:08:54'),
(105, 'amp_enabled', '1', '2025-07-04 07:08:55', '2025-07-04 07:44:12'),
(106, 'pwa_enabled', '1', '2025-07-04 07:08:55', '2025-07-04 07:44:12'),
(107, 'open_graph_enabled', '1', '2025-07-04 07:08:55', '2025-07-04 07:08:55'),
(108, 'twitter_cards_enabled', '1', '2025-07-04 07:08:55', '2025-07-04 07:08:55'),
(109, 'schema_organization', '1', '2025-07-04 07:08:55', '2025-07-04 07:08:55'),
(110, 'schema_website', '1', '2025-07-04 07:08:55', '2025-07-04 07:08:55'),
(111, 'schema_breadcrumbs', '1', '2025-07-04 07:08:55', '2025-07-04 07:08:55'),
(112, 'receipt_site_name', 'Exchange Bridge', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(113, 'receipt_site_tagline', 'Exchange Taka Globally', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(114, 'receipt_logo_enabled', 'no', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(115, 'receipt_website', 'https://demo.exchange-bridge.rf.gd', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(116, 'receipt_email', 'info@exchangebridge.com', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(117, 'receipt_phone', '+8801869838872', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(118, 'receipt_bg_color', '#ffffff', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(119, 'receipt_header_color', '#1e3a8a', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(120, 'receipt_footer_color', '#1e3a8a', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(121, 'receipt_section_color', '#1e40af', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(122, 'receipt_accent_color', '#70d866', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(123, 'receipt_content_bg_color', '#f8fafc', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(124, 'receipt_watermark_color', '#f3f4f6', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(125, 'receipt_watermark_text', 'EXCHANGE', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(126, 'receipt_customer_details_title', 'Customer Details', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(127, 'receipt_exchange_details_title', 'Exchange Details', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(128, 'receipt_name_label', 'Name', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(129, 'receipt_email_label', 'Email', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(130, 'receipt_phone_label', 'Phone', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(131, 'receipt_address_label', 'Address', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(132, 'receipt_from_label', 'From', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(133, 'receipt_to_label', 'To', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(134, 'receipt_rate_label', 'Rate', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(135, 'receipt_sent_label', 'Sent', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(136, 'receipt_received_label', 'Received', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(137, 'receipt_website_label', 'Website', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(138, 'receipt_email_footer_label', 'Email Address', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(139, 'receipt_phone_footer_label', 'Contact Number', '2025-07-05 04:06:09', '2025-07-05 04:16:00'),
(140, 'footer_copyright', '© 2025 Exchange Bridge | All rights reserved.', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(141, 'enable_popup_notice', 'yes', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(142, 'social_telegram', '', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(143, 'enable_whatsapp_button', 'yes', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(144, 'whatsapp_number', '+97466489944', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(145, 'whatsapp_message', 'হ্যালো! Exchange Bridge অপারেটর।', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(146, 'enable_tawkto', 'yes', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(147, 'tawkto_widget_code', '6869a98370e7fd1919383828/1ivebsat9', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(148, 'meta_description', '', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(149, 'meta_keywords', '', '2025-07-05 04:31:45', '2025-07-22 14:26:34');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `created_at`, `updated_at`) VALUES
(150, 'custom_tracking_code', '<?php\r\n// Start session\r\nsession_start();\r\n\r\n// Define access constant\r\ndefine(\'ALLOW_ACCESS\', true);\r\n\r\n// Include configuration files\r\nrequire_once \'../../includes/config.php\';\r\nrequire_once \'../../includes/db.php\';\r\nrequire_once \'../../includes/functions.php\';\r\nrequire_once \'../../includes/auth.php\';\r\n\r\n// Check if user is logged in, if not redirect to login page\r\nif (!Auth::isLoggedIn()) {\r\n    header(\"Location: ../login.php\");\r\n    exit;\r\n}\r\n\r\n// Check if user has admin role for certain settings\r\n$isAdmin = Auth::isAdmin();\r\n\r\n// Get media files for logo/favicon selection\r\n$db = Database::getInstance();\r\n$mediaFiles = $db->getRows(\"SELECT * FROM media WHERE file_type = \'image\' ORDER BY created_at DESC LIMIT 100\");\r\n\r\n// Check for success message\r\n$successMessage = \'\';\r\nif (isset($_SESSION[\'success_message\'])) {\r\n    $successMessage = $_SESSION[\'success_message\'];\r\n    unset($_SESSION[\'success_message\']);\r\n}\r\n\r\n// Check for error message\r\n$errorMessage = \'\';\r\nif (isset($_SESSION[\'error_message\'])) {\r\n    $errorMessage = $_SESSION[\'error_message\'];\r\n    unset($_SESSION[\'error_message\']);\r\n}\r\n\r\n// Handle form submission\r\nif ($_SERVER[\'REQUEST_METHOD\'] === \'POST\') {\r\n    try {\r\n        // Debug: Log form submission\r\n        error_log(\"Settings form submitted\");\r\n        \r\n        // Handle file uploads\r\n        $logoFile = \'\';\r\n        $faviconFile = \'\';\r\n        \r\n        // Handle logo upload\r\n        if (isset($_FILES[\'site_logo_upload\']) && $_FILES[\'site_logo_upload\'][\'error\'] === UPLOAD_ERR_OK) {\r\n            $uploadDir = \'../../assets/uploads/media/\';\r\n            if (!file_exists($uploadDir)) {\r\n                mkdir($uploadDir, 0755, true);\r\n            }\r\n            $result = uploadFile($_FILES[\'site_logo_upload\'], $uploadDir);\r\n            if ($result[\'success\']) {\r\n                $logoFile = \'assets/uploads/media/\' . $result[\'filename\'];\r\n            }\r\n        }\r\n        \r\n        // Handle favicon upload\r\n        if (isset($_FILES[\'site_favicon_upload\']) && $_FILES[\'site_favicon_upload\'][\'error\'] === UPLOAD_ERR_OK) {\r\n            $uploadDir = \'../../assets/uploads/media/\';\r\n            if (!file_exists($uploadDir)) {\r\n                mkdir($uploadDir, 0755, true);\r\n            }\r\n            $result = uploadFile($_FILES[\'site_favicon_upload\'], $uploadDir);\r\n            if ($result[\'success\']) {\r\n                $faviconFile = \'assets/uploads/media/\' . $result[\'filename\'];\r\n            }\r\n        }\r\n        \r\n        // Process each setting with proper handling\r\n        $settings = [\r\n            // General Settings\r\n            \'site_name\' => isset($_POST[\'site_name\']) ? trim($_POST[\'site_name\']) : \'\',\r\n            \'site_tagline\' => isset($_POST[\'site_tagline\']) ? trim($_POST[\'site_tagline\']) : \'\',\r\n            \'operator_status\' => isset($_POST[\'operator_status\']) ? $_POST[\'operator_status\'] : \'online\',\r\n            \'working_hours\' => isset($_POST[\'working_hours\']) ? trim($_POST[\'working_hours\']) : \'\',\r\n            \'footer_copyright\' => isset($_POST[\'footer_copyright\']) ? trim($_POST[\'footer_copyright\']) : \'\',\r\n            \'enable_notification_sound\' => isset($_POST[\'enable_notification_sound\']) ? \'yes\' : \'no\',\r\n            \'enable_popup_notice\' => isset($_POST[\'enable_popup_notice\']) ? \'yes\' : \'no\',\r\n            \r\n            // Logo & Branding Settings\r\n            \'logo_type\' => isset($_POST[\'logo_type\']) ? $_POST[\'logo_type\'] : \'text\',\r\n            \'site_logo_text\' => isset($_POST[\'site_logo_text\']) ? trim($_POST[\'site_logo_text\']) : \'\',\r\n            \'site_logo\' => !empty($logoFile) ? $logoFile : (isset($_POST[\'selected_logo_media\']) && !empty($_POST[\'selected_logo_media\']) ? $_POST[\'selected_logo_media\'] : getSetting(\'site_logo\', \'\')),\r\n            \'site_favicon\' => !empty($faviconFile) ? $faviconFile : (isset($_POST[\'selected_favicon_media\']) && !empty($_POST[\'selected_favicon_media\']) ? $_POST[\'selected_favicon_media\'] : getSetting(\'site_favicon\', \'\')),\r\n            \'logo_size\' => isset($_POST[\'logo_size\']) ? $_POST[\'logo_size\'] : \'medium\',\r\n            \'logo_position\' => isset($_POST[\'logo_position\']) ? $_POST[\'logo_position\'] : \'left\',\r\n            \'logo_max_width\' => isset($_POST[\'logo_max_width\']) ? intval($_POST[\'logo_max_width\']) : 200,\r\n            \'logo_max_height\' => isset($_POST[\'logo_max_height\']) ? intval($_POST[\'logo_max_height\']) : 60,\r\n            \r\n            // Extended Color Settings\r\n            \'primary_color\' => isset($_POST[\'primary_color\']) ? $_POST[\'primary_color\'] : \'#5D5CDE\',\r\n            \'secondary_color\' => isset($_POST[\'secondary_color\']) ? $_POST[\'secondary_color\'] : \'#6c757d\',\r\n            \'success_color\' => isset($_POST[\'success_color\']) ? $_POST[\'success_color\'] : \'#28a745\',\r\n            \'warning_color\' => isset($_POST[\'warning_color\']) ? $_POST[\'warning_color\'] : \'#ffc107\',\r\n            \'danger_color\' => isset($_POST[\'danger_color\']) ? $_POST[\'danger_color\'] : \'#dc3545\',\r\n            \'info_color\' => isset($_POST[\'info_color\']) ? $_POST[\'info_color\'] : \'#17a2b8\',\r\n            \'light_color\' => isset($_POST[\'light_color\']) ? $_POST[\'light_color\'] : \'#f8f9fa\',\r\n            \'dark_color\' => isset($_POST[\'dark_color\']) ? $_POST[\'dark_color\'] : \'#343a40\',\r\n            \'header_color\' => isset($_POST[\'header_color\']) ? $_POST[\'header_color\'] : \'#1E3A8A\',\r\n            \'footer_color\' => isset($_POST[\'footer_color\']) ? $_POST[\'footer_color\'] : \'#1E3A8A\',\r\n            \'body_bg_color\' => isset($_POST[\'body_bg_color\']) ? $_POST[\'body_bg_color\'] : \'#ffffff\',\r\n            \'text_color\' => isset($_POST[\'text_color\']) ? $_POST[\'text_color\'] : \'#212529\',\r\n            \'link_color\' => isset($_POST[\'link_color\']) ? $_POST[\'link_color\'] : \'#007bff\',\r\n            \'border_color\' => isset($_POST[\'border_color\']) ? $_POST[\'border_color\'] : \'#dee2e6\',\r\n            \r\n            // Navigation Settings\r\n            \'nav_style\' => isset($_POST[\'nav_style\']) ? $_POST[\'nav_style\'] : \'horizontal\',\r\n            \'nav_position\' => isset($_POST[\'nav_position\']) ? $_POST[\'nav_position\'] : \'top\',\r\n            \'show_breadcrumbs\' => isset($_POST[\'show_breadcrumbs\']) ? \'yes\' : \'no\',\r\n            \'custom_menu_items\' => isset($_POST[\'custom_menu_items\']) ? $_POST[\'custom_menu_items\'] : \'\',\r\n            \r\n            // Contact Info Settings\r\n            \'contact_phone\' => isset($_POST[\'contact_phone\']) ? trim($_POST[\'contact_phone\']) : \'\',\r\n            \'contact_whatsapp\' => isset($_POST[\'contact_whatsapp\']) ? trim($_POST[\'contact_whatsapp\']) : \'\',\r\n            \'contact_email\' => isset($_POST[\'contact_email\']) ? trim($_POST[\'contact_email\']) : \'\',\r\n            \'contact_address\' => isset($_POST[\'contact_address\']) ? trim($_POST[\'contact_address\']) : \'\',\r\n            \r\n            // Social Media Settings\r\n            \'social_facebook\' => isset($_POST[\'social_facebook\']) ? trim($_POST[\'social_facebook\']) : \'\',\r\n            \'social_twitter\' => isset($_POST[\'social_twitter\']) ? trim($_POST[\'social_twitter\']) : \'\',\r\n            \'social_telegram\' => isset($_POST[\'social_telegram\']) ? trim($_POST[\'social_telegram\']) : \'\',\r\n            \'social_instagram\' => isset($_POST[\'social_instagram\']) ? trim($_POST[\'social_instagram\']) : \'\',\r\n            \'social_linkedin\' => isset($_POST[\'social_linkedin\']) ? trim($_POST[\'social_linkedin\']) : \'\',\r\n            \'social_youtube\' => isset($_POST[\'social_youtube\']) ? trim($_POST[\'social_youtube\']) : \'\',\r\n            \r\n            // Features Settings\r\n            \'enable_whatsapp_button\' => isset($_POST[\'enable_whatsapp_button\']) ? \'yes\' : \'no\',\r\n            \'whatsapp_number\' => isset($_POST[\'whatsapp_number\']) ? trim($_POST[\'whatsapp_number\']) : \'\',\r\n            \'whatsapp_message\' => isset($_POST[\'whatsapp_message\']) ? trim($_POST[\'whatsapp_message\']) : \'\',\r\n            \'enable_tawkto\' => isset($_POST[\'enable_tawkto\']) ? \'yes\' : \'no\',\r\n            \'tawkto_widget_code\' => isset($_POST[\'tawkto_widget_code\']) ? $_POST[\'tawkto_widget_code\'] : \'\',\r\n            \r\n            // Advanced Settings - SEO\r\n            \'meta_description\' => isset($_POST[\'meta_description\']) ? trim($_POST[\'meta_description\']) : \'\',\r\n            \'meta_keywords\' => isset($_POST[\'meta_keywords\']) ? trim($_POST[\'meta_keywords\']) : \'\',\r\n            \'google_site_verification\' => isset($_POST[\'google_site_verification\']) ? trim($_POST[\'google_site_verification\']) : \'\',\r\n            \r\n            // Advanced Settings - Analytics & Tracking\r\n            \'google_analytics_code\' => isset($_POST[\'google_analytics_code\']) ? $_POST[\'google_analytics_code\'] : \'\',\r\n            \'google_analytics_id\' => isset($_POST[\'google_analytics_id\']) ? trim($_POST[\'google_analytics_id\']) : \'\',\r\n            \'facebook_pixel_id\' => isset($_POST[\'facebook_pixel_id\']) ? trim($_POST[\'facebook_pixel_id\']) : \'\',\r\n            \'custom_tracking_code\' => isset($_POST[\'custom_tracking_code\']) ? $_POST[\'custom_tracking_code\'] : \'\',\r\n            \r\n            // Advanced Settings - Security\r\n            \'maintenance_mode\' => isset($_POST[\'maintenance_mode\']) ? \'yes\' : \'no\',\r\n            \'maintenance_message\' => isset($_POST[\'maintenance_message\']) ? trim($_POST[\'maintenance_message\']) : \'\',\r\n            \'enable_captcha\' => isset($_POST[\'enable_captcha\']) ? \'yes\' : \'no\',\r\n            \'recaptcha_site_key\' => isset($_POST[\'recaptcha_site_key\']) ? trim($_POST[\'recaptcha_site_key\']) : \'\',\r\n            \'recaptcha_secret_key\' => isset($_POST[\'recaptcha_secret_key\']) ? trim($_POST[\'recaptcha_secret_key\']) : \'\',\r\n            \r\n            // Advanced Settings - Performance\r\n            \'enable_caching\' => isset($_POST[\'enable_caching\']) ? \'yes\' : \'no\',\r\n            \'cache_duration\' => isset($_POST[\'cache_duration\']) ? intval($_POST[\'cache_duration\']) : \'60\',\r\n            \'enable_compression\' => isset($_POST[\'enable_compression\']) ? \'yes\' : \'no\',\r\n            \'minify_assets\' => isset($_POST[\'minify_assets\']) ? \'yes\' : \'no\',\r\n            \r\n            // Advanced Settings - Email\r\n            \'email_method\' => isset($_POST[\'email_method\']) ? $_POST[\'email_method\'] : \'mail\',\r\n            \'smtp_host\' => isset($_POST[\'smtp_host\']) ? trim($_POST[\'smtp_host\']) : \'\',\r\n            \'smtp_port\' => isset($_POST[\'smtp_port\']) ? intval($_POST[\'smtp_port\']) : \'587\',\r\n            \'smtp_encryption\' => isset($_POST[\'smtp_encryption\']) ? $_POST[\'smtp_encryption\'] : \'tls\',\r\n            \'smtp_username\' => isset($_POST[\'smtp_username\']) ? trim($_POST[\'smtp_username\']) : \'\',\r\n            \'smtp_password\' => isset($_POST[\'smtp_password\']) ? $_POST[\'smtp_password\'] : \'\',\r\n            \'email_from_name\' => isset($_POST[\'email_from_name\']) ? trim($_POST[\'email_from_name\']) : \'\',\r\n            \'email_from_address\' => isset($_POST[\'email_from_address\']) ? trim($_POST[\'email_from_address\']) : \'\',\r\n            \r\n            // Advanced Settings - API\r\n            \'enable_api\' => isset($_POST[\'enable_api\']) ? \'yes\' : \'no\',\r\n            \'api_rate_limit\' => isset($_POST[\'api_rate_limit\']) ? intval($_POST[\'api_rate_limit\']) : \'60\',\r\n            \'allowed_origins\' => isset($_POST[\'allowed_origins\']) ? $_POST[\'allowed_origins\'] : \'*\',\r\n            \'api_require_auth\' => isset($_POST[\'api_require_auth\']) ? \'yes\' : \'no\',\r\n            \r\n            // Advanced Settings - Custom Scripts\r\n            \'header_scripts\' => isset($_POST[\'header_scripts\']) ? $_POST[\'header_scripts\'] : \'\',\r\n            \'footer_scripts\' => isset($_POST[\'footer_scripts\']) ? $_POST[\'footer_scripts\'] : \'\',\r\n            \'custom_css\' => isset($_POST[\'custom_css\']) ? $_POST[\'custom_css\'] : \'\',\r\n            \r\n            // Advanced Settings - Developer\r\n            \'debug_mode\' => isset($_POST[\'debug_mode\']) ? \'yes\' : \'no\',\r\n            \'log_queries\' => isset($_POST[\'log_queries\']) ? \'yes\' : \'no\',\r\n            \'log_level\' => isset($_POST[\'log_level\']) ? $_POST[\'log_level\'] : \'error\',\r\n            \'enable_profiler\' => isset($_POST[\'enable_profiler\']) ? \'yes\' : \'no\',\r\n            \r\n            // Advanced Settings - Backup\r\n            \'auto_backup\' => isset($_POST[\'auto_backup\']) ? \'yes\' : \'no\',\r\n            \'backup_frequency\' => isset($_POST[\'backup_frequency\']) ? $_POST[\'backup_frequency\'] : \'daily\',\r\n            \'backup_retention\' => isset($_POST[\'backup_retention\']) ? intval($_POST[\'backup_retention\']) : \'30\',\r\n        ];\r\n        \r\n        // Debug: Log settings count\r\n        error_log(\"Processing \" . count($settings) . \" settings\");\r\n        \r\n        // Get database instance\r\n        $success = true;\r\n        $failed_settings = [];\r\n        \r\n        // Update each setting\r\n        foreach ($settings as $key => $value) {\r\n            $result = updateSetting($key, $value);\r\n            if (!$result) {\r\n                $success = false;\r\n                $failed_settings[] = $key;\r\n                error_log(\"Failed to update setting: \" . $key . \" = \" . $value);\r\n            } else {\r\n                error_log(\"Successfully updated setting: \" . $key . \" = \" . $value);\r\n            }\r\n        }\r\n        \r\n        if ($success) {\r\n            $_SESSION[\'success_message\'] = \'All settings updated successfully!\';\r\n            error_log(\"All settings updated successfully\");\r\n        } else {\r\n            $_SESSION[\'error_message\'] = \'Failed to update some settings: \' . implode(\', \', $failed_settings);\r\n            error_log(\"Failed to update settings: \" . implode(\', \', $failed_settings));\r\n        }\r\n        \r\n    } catch (Exception $e) {\r\n        $_SESSION[\'error_message\'] = \'Error updating settings: \' . $e->getMessage();\r\n        error_log(\"Exception in settings update: \" . $e->getMessage());\r\n    }\r\n    \r\n    // Redirect to refresh page\r\n    header(\"Location: index.php\");\r\n    exit;\r\n}\r\n\r\n// Include header\r\ninclude \'../includes/header.php\';\r\n?>\r\n\r\n<!-- Breadcrumbs-->\r\n<ol class=\"breadcrumb\">\r\n    <li class=\"breadcrumb-item\">\r\n        <a href=\"../index.php\">Dashboard</a>\r\n    </li>\r\n    <li class=\"breadcrumb-item active\">Settings</li>\r\n</ol>\r\n\r\n<!-- Page Content -->\r\n<div class=\"card mb-4\">\r\n    <div class=\"card-header\">\r\n        <i class=\"fas fa-cog mr-1\"></i> Site Settings\r\n        <div class=\"float-right\">\r\n            <small class=\"text-muted\">Last updated: <?php echo date(\'M d, Y H:i:s\'); ?></small>\r\n        </div>\r\n    </div>\r\n    <div class=\"card-body\">\r\n        <?php if (!empty($successMessage)): ?>\r\n        <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">\r\n            <i class=\"fas fa-check-circle mr-2\"></i><?php echo $successMessage; ?>\r\n            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\r\n                <span aria-hidden=\"true\">&times;</span>\r\n            </button>\r\n        </div>\r\n        <?php endif; ?>\r\n        \r\n        <?php if (!empty($errorMessage)): ?>\r\n        <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\r\n            <i class=\"fas fa-exclamation-triangle mr-2\"></i><?php echo $errorMessage; ?>\r\n            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\r\n                <span aria-hidden=\"true\">&times;</span>\r\n            </button>\r\n        </div>\r\n        <?php endif; ?>\r\n        \r\n        <!-- Debug Info (remove in production) -->\r\n        <?php if (getSetting(\'debug_mode\', \'no\') === \'yes\'): ?>\r\n        <div class=\"alert alert-info\">\r\n            <strong>Debug Info:</strong> Settings form ready. Current user: <?php echo Auth::getUser()[\'username\'] ?? \'Unknown\'; ?>\r\n        </div>\r\n        <?php endif; ?>\r\n        \r\n        <form id=\"settingsForm\" action=\"index.php\" method=\"post\" enctype=\"multipart/form-data\" onsubmit=\"return validateForm()\">\r\n            <!-- Add CSRF protection -->\r\n            <input type=\"hidden\" name=\"csrf_token\" value=\"<?php echo $_SESSION[\'csrf_token\'] = bin2hex(random_bytes(32)); ?>\">\r\n            \r\n            <ul class=\"nav nav-tabs\" id=\"settingsTabs\" role=\"tablist\">\r\n                <li class=\"nav-item\">\r\n                    <a class=\"nav-link active\" id=\"general-tab\" data-toggle=\"tab\" href=\"#general\" role=\"tab\" aria-controls=\"general\" aria-selected=\"true\">\r\n                        <i class=\"fas fa-globe mr-1\"></i> General\r\n                    </a>\r\n                </li>\r\n                <li class=\"nav-item\">\r\n                    <a class=\"nav-link\" id=\"branding-tab\" data-toggle=\"tab\" href=\"#branding\" role=\"tab\" aria-controls=\"branding\" aria-selected=\"false\">\r\n                        <i class=\"fas fa-image mr-1\"></i> Logo & Branding\r\n                    </a>\r\n                </li>\r\n                <li class=\"nav-item\">\r\n                    <a class=\"nav-link\" id=\"appearance-tab\" data-toggle=\"tab\" href=\"#appearance\" role=\"tab\" aria-controls=\"appearance\" aria-selected=\"false\">\r\n                        <i class=\"fas fa-paint-brush mr-1\"></i> Colors & Appearance\r\n                    </a>\r\n                </li>\r\n                <li class=\"nav-item\">\r\n                    <a class=\"nav-link\" id=\"navigation-tab\" data-toggle=\"tab\" href=\"#navigation\" role=\"tab\" aria-controls=\"navigation\" aria-selected=\"false\">\r\n                        <i class=\"fas fa-bars mr-1\"></i> Navigation\r\n                    </a>\r\n                </li>\r\n                <li class=\"nav-item\">\r\n                    <a class=\"nav-link\" id=\"contact-tab\" data-toggle=\"tab\" href=\"#contact\" role=\"tab\" aria-controls=\"contact\" aria-selected=\"false\">\r\n                        <i class=\"fas fa-address-card mr-1\"></i> Contact Info\r\n                    </a>\r\n                </li>\r\n                <li class=\"nav-item\">\r\n                    <a class=\"nav-link\" id=\"social-tab\" data-toggle=\"tab\" href=\"#social\" role=\"tab\" aria-controls=\"social\" aria-selected=\"false\">\r\n                        <i class=\"fas fa-share-alt mr-1\"></i> Social Media\r\n                    </a>\r\n                </li>\r\n                <li class=\"nav-item\">\r\n                    <a class=\"nav-link\" id=\"features-tab\" data-toggle=\"tab\" href=\"#features\" role=\"tab\" aria-controls=\"features\" aria-selected=\"false\">\r\n                        <i class=\"fas fa-star mr-1\"></i> Features\r\n                    </a>\r\n                </li>\r\n                <li class=\"nav-item\">\r\n                    <a class=\"nav-link\" id=\"advanced-tab\" data-toggle=\"tab\" href=\"#advanced\" role=\"tab\" aria-controls=\"advanced\" aria-selected=\"false\">\r\n                        <i class=\"fas fa-code mr-1\"></i> Advanced\r\n                    </a>\r\n                </li>\r\n            </ul>\r\n            \r\n            <div class=\"tab-content mt-4\" id=\"settingsTabContent\">\r\n                <!-- General Settings -->\r\n                <div class=\"tab-pane fade show active\" id=\"general\" role=\"tabpanel\" aria-labelledby=\"general-tab\">\r\n                    <div class=\"row\">\r\n                        <div class=\"col-md-6\">\r\n                            <div class=\"form-group\">\r\n                                <label for=\"site_name\">Site Name <span class=\"text-danger\">*</span></label>\r\n                                <input type=\"text\" class=\"form-control\" id=\"site_name\" name=\"site_name\" \r\n                                       value=\"<?php echo htmlspecialchars(getSetting(\'site_name\', SITE_NAME)); ?>\" required>\r\n                            </div>\r\n                            \r\n                            <div class=\"form-group\">\r\n                                <label for=\"site_tagline\">Site Tagline</label>\r\n                                <input type=\"text\" class=\"form-control\" id=\"site_tagline\" name=\"site_tagline\" \r\n                                       value=\"<?php echo htmlspecialchars(getSetting(\'site_tagline\', \'Exchange Taka Globally\')); ?>\">\r\n                            </div>\r\n                            \r\n                            <div class=\"form-group\">\r\n                                <label for=\"operator_status\">Operator Status</label>\r\n                                <select class=\"form-control\" id=\"operator_status\" name=\"operator_status\">\r\n                                    <option value=\"online\" <?php echo getSetting(\'operator_status\', \'online\') === \'online\' ? \'selected\' : \'\'; ?>>Online</option>\r\n                                    <option value=\"away\" <?php echo getSetting(\'operator_status\', \'online\') === \'away\' ? \'selected\' : \'\'; ?>>Away</option>\r\n                                    <option value=\"offline\" <?php echo getSetting(\'operator_status\', \'online\') === \'offline\' ? \'selected\' : \'\'; ?>>Offline</option>\r\n                                </select>\r\n                            </div>\r\n                            \r\n                            <div class=\"form-group\">\r\n                                <label for=\"working_hours\">Working Hours</label>\r\n                                <input type=\"text\" class=\"form-control\" id=\"working_hours\" name=\"working_hours\" \r\n                                       value=\"<?php echo htmlspecialchars(getSetting(\'working_hours\', \'9 am-11.50pm +6\')); ?>\">\r\n                            </div>\r\n                        </div>\r\n                        \r\n                        <div class=\"col-md-6\">\r\n                            <div class=\"form-group\">\r\n                                <label for=\"footer_copyright\">Footer Copyright Text</label>\r\n                                <input type=\"text\" class=\"form-control\" id=\"footer_copyright\" name=\"footer_copyright\" \r\n                                       value=\"<?php echo htmlspecialchars(getSetting(\'footer_copyright\', \'© \' . date(\'Y\') . \' \' . getSetting(\'site_name\', SITE_NAME) . \'. All rights reserved.\')); ?>\">\r\n                            </div>\r\n                            \r\n                            <div class=\"form-group\">\r\n                                <div class=\"custom-control custom-switch\">\r\n                                    <input type=\"checkbox\" class=\"custom-control-input\" id=\"enable_notification_sound\" name=\"enable_notification_sound\" \r\n                                           <?php echo getSetting(\'enable_notification_sound\', \'yes\') === \'yes\' ? \'checked\' : \'\'; ?>>\r\n                                    <label class=\"custom-control-label\" for=\"enable_notification_sound\">Enable Notification Sounds</label>\r\n                                </div>\r\n                            </div>\r\n                            \r\n                            <div class=\"form-group\">\r\n                                <div class=\"custom-control custom-switch\">\r\n                                    <input type=\"checkbox\" class=\"custom-control-input\" id=\"enable_popup_notice\" name=\"enable_popup_notice\" \r\n                                           <?php echo getSetting(\'enable_popup_notice\', \'yes\') === \'yes\' ? \'checked\' : \'\'; ?>>\r\n                                    <label class=\"custom-control-label\" for=\"enable_popup_notice\">Enable Popup Notices</label>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                \r\n                <!-- Logo & Branding Settings -->\r\n                <div class=\"tab-pane fade\" id=\"branding\" role=\"tabpanel\" aria-labelledby=\"branding-tab\">\r\n                    <div class=\"row\">\r\n                        <div class=\"col-md-8\">\r\n                            <!-- Logo Type Selection -->\r\n                            <div class=\"form-group\">\r\n                                <label>Logo Type</label>\r\n                                <div class=\"form-check\">\r\n                                    <input class=\"form-check-input\" type=\"radio\" name=\"logo_type\" id=\"logo_text\" value=\"text\" \r\n                                           <?php echo getSetting(\'logo_type\', \'text\') === \'text\' ? \'checked\' : \'\'; ?>>\r\n                                    <label class=\"form-check-label\" for=\"logo_text\">Text Logo Only</label>\r\n                                </div>\r\n                                <div class=\"form-check\">\r\n                                    <input class=\"form-check-input\" type=\"radio\" name=\"logo_type\" id=\"logo_image\" value=\"image\" \r\n                                           <?php echo getSetting(\'logo_type\', \'text\') === \'image\' ? \'checked\' : \'\'; ?>>\r\n                                    <label class=\"form-check-label\" for=\"logo_image\">Image Logo Only</label>\r\n                                </div>\r\n                                <div class=\"form-check\">\r\n                                    <input class=\"form-check-input\" type=\"radio\" name=\"logo_type\" id=\"logo_both\" value=\"both\" \r\n                                           <?php echo getSetting(\'logo_type\', \'text\') === \'both\' ? \'checked\' : \'\'; ?>>\r\n                                    <label class=\"form-check-label\" for=\"logo_both\">Image + Text Logo</label>\r\n                                </div>\r\n                            </div>\r\n                            \r\n                            <!-- Text Logo Settings -->\r\n                            <div id=\"text-logo-settings\" class=\"form-group\">\r\n                                <label for=\"site_logo_text\">Logo Text</label>\r\n                                <input type=\"text\" class=\"form-control\" id=\"site_logo_text\" name=\"site_logo_text\" \r\n                                       value=\"<?php echo htmlspecialchars(getSetting(\'site_logo_text\', getSetting(\'site_name\', SITE_NAME))); ?>\">\r\n                            </div>\r\n                            \r\n                            <!-- Image Logo Settings -->\r\n                            <div id=\"image-logo-settings\" class=\"form-group\">\r\n                                <label>Site Logo</label>\r\n                                \r\n                                <!-- Current Logo Display -->\r\n                                <?php $currentLogo = getSetting(\'site_logo\', \'\'); ?>\r\n                                <?php if (!empty($currentLogo) && file_exists(\'../../\' . $currentLogo)): ?>\r\n                                <div class=\"current-logo mb-3 p-3 border rounded\">\r\n                                    <div class=\"d-flex align-items-center\">\r\n                                        <img src=\"<?php echo SITE_URL . \'/\' . $currentLogo; ?>\" \r\n                                             alt=\"Current Logo\" \r\n                                             class=\"mr-3\" \r\n                                             style=\"max-width: 100px; max-height: 50px; object-fit: contain;\">\r\n                                        <div class=\"flex-grow-1\">\r\n                                            <strong>Current Logo:</strong> <?php echo basename($currentLogo); ?>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                <?php endif; ?>\r\n                                \r\n                                <!-- Logo Upload/Selection Tabs -->\r\n                                <ul class=\"nav nav-tabs\" id=\"logoTabs\" role=\"tablist\">\r\n                                    <li class=\"nav-item\">\r\n                                        <a class=\"nav-link active\" id=\"upload-logo-tab\" data-toggle=\"tab\" href=\"#upload-logo\" role=\"tab\">\r\n                                            <i class=\"fas fa-upload mr-1\"></i> Upload New\r\n                                        </a>\r\n                                    </li>\r\n                                    <li class=\"nav-item\">\r\n                                        <a class=\"nav-link\" id=\"media-logo-tab\" data-toggle=\"tab\" href=\"#media-logo\" role=\"tab\">\r\n                                            <i class=\"fas fa-images mr-1\"></i> Select from Media\r\n                                        </a>\r\n                                    </li>\r\n                                </ul>\r\n                                \r\n                                <div class=\"tab-content mt-3\">\r\n                                    <!-- Upload New Logo -->\r\n                                    <div class=\"tab-pane fade show active\" id=\"upload-logo\" role=\"tabpanel\">\r\n                                        <div class=\"custom-file\">\r\n                                            <input type=\"file\" class=\"custom-file-input\" id=\"site_logo_upload\" name=\"site_logo_upload\" accept=\"image/*\">\r\n                                            <label class=\"custom-file-label\" for=\"site_logo_upload\">Choose logo file</label>\r\n                                        </div>\r\n                                        <small class=\"form-text text-muted\">Recommended size: 200x60 pixels. Supported formats: PNG, JPG, SVG</small>\r\n                                    </div>\r\n                                    \r\n                                    <!-- Select from Media Library -->\r\n                                    <div class=\"tab-pane fade\" id=\"media-logo\" role=\"tabpanel\">\r\n                                        <?php if (count($mediaFiles) > 0): ?>\r\n                                        <div class=\"media-gallery\" style=\"max-height: 200px; overflow-y: auto;\">\r\n                                            <div class=\"row\">\r\n                                                <?php foreach ($mediaFiles as $media): ?>\r\n                                                <div class=\"col-md-2 col-sm-3 col-4 mb-2\">\r\n                                                    <div class=\"media-item-logo\" data-media-path=\"<?php echo $media[\'file_path\']; ?>\" style=\"cursor: pointer; border: 2px solid transparent; border-radius: 8px; padding: 5px;\">\r\n                                                        <img src=\"<?php echo SITE_URL . \'/\' . $media[\'file_path\']; ?>\" \r\n                                                             alt=\"<?php echo htmlspecialchars($media[\'original_name\']); ?>\" \r\n                                                             class=\"img-fluid rounded\" \r\n                                                             style=\"width: 100%; height: 40px; object-fit: cover;\">\r\n                                                        <small class=\"d-block text-center mt-1\" style=\"font-size: 9px;\"><?php echo htmlspecialchars(substr($media[\'original_name\'], 0, 10)); ?></small>\r\n                                                    </div>\r\n                                                </div>\r\n                                                <?php endforeach; ?>\r\n                                            </div>\r\n                                        </div>\r\n                                        <input type=\"hidden\" name=\"selected_logo_media\" id=\"selected_logo_media\">\r\n                                        <?php else: ?>\r\n                                        <div class=\"alert alert-info\">\r\n                                            <i class=\"fas fa-info-circle mr-2\"></i>\r\n                                            No media files found. <a href=\"../media/\" target=\"_blank\">Upload some images to the media library</a> first.\r\n                                        </div>\r\n                                        <?php endif; ?>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                            \r\n                            <!-- Logo Positioning & Size -->\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-6\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"logo_position\">Logo Position</label>\r\n                                        <select class=\"form-control\" id=\"logo_position\" name=\"logo_position\">\r\n                                            <option value=\"left\" <?php echo getSetting(\'logo_position\', \'left\') === \'left\' ? \'selected\' : \'\'; ?>>Left</option>\r\n                                            <option value=\"center\" <?php echo getSetting(\'logo_position\', \'left\') === \'center\' ? \'selected\' : \'\'; ?>>Center</option>\r\n                                            <option value=\"right\" <?php echo getSetting(\'logo_position\', \'left\') === \'right\' ? \'selected\' : \'\'; ?>>Right</option>\r\n                                        </select>\r\n                                    </div>\r\n                                </div>\r\n                                <div class=\"col-md-6\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"logo_size\">Logo Size</label>\r\n                                        <select class=\"form-control\" id=\"logo_size\" name=\"logo_size\">\r\n                                            <option value=\"small\" <?php echo getSetting(\'logo_size\', \'medium\') === \'small\' ? \'selected\' : \'\'; ?>>Small</option>\r\n                                            <option value=\"medium\" <?php echo getSetting(\'logo_size\', \'medium\') === \'medium\' ? \'selected\' : \'\'; ?>>Medium</option>\r\n                                            <option value=\"large\" <?php echo getSetting(\'logo_size\', \'medium\') === \'large\' ? \'selected\' : \'\'; ?>>Large</option>\r\n                                            <option value=\"custom\" <?php echo getSetting(\'logo_size\', \'medium\') === \'custom\' ? \'selected\' : \'\'; ?>>Custom</option>\r\n                                        </select>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                            \r\n                            <!-- Custom Logo Dimensions -->\r\n                            <div id=\"custom-logo-size\" class=\"row\" style=\"display: <?php echo getSetting(\'logo_size\', \'medium\') === \'custom\' ? \'block\' : \'none\'; ?>;\">\r\n                                <div class=\"col-md-6\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"logo_max_width\">Max Width (px)</label>\r\n                                        <input type=\"number\" class=\"form-control\" id=\"logo_max_width\" name=\"logo_max_width\" \r\n                                               value=\"<?php echo getSetting(\'logo_max_width\', 200); ?>\" min=\"50\" max=\"500\">\r\n                                    </div>\r\n                                </div>\r\n                                <div class=\"col-md-6\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"logo_max_height\">Max Height (px)</label>\r\n                                        <input type=\"number\" class=\"form-control\" id=\"logo_max_height\" name=\"logo_max_height\" \r\n                                               value=\"<?php echo getSetting(\'logo_max_height\', 60); ?>\" min=\"30\" max=\"200\">\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                            \r\n                            <!-- Favicon Settings -->\r\n                            <div class=\"form-group\">\r\n                                <label>Site Favicon</label>\r\n                                \r\n                                <!-- Current Favicon Display -->\r\n                                <?php $currentFavicon = getSetting(\'site_favicon\', \'\'); ?>\r\n                                <?php if (!empty($currentFavicon) && file_exists(\'../../\' . $currentFavicon)): ?>\r\n                                <div class=\"current-favicon mb-3 p-3 border rounded\">\r\n                                    <div class=\"d-flex align-items-center\">\r\n                                        <img src=\"<?php echo SITE_URL . \'/\' . $currentFavicon; ?>\" \r\n                                             alt=\"Current Favicon\" \r\n                                             class=\"mr-3\" \r\n                                             style=\"width: 32px; height: 32px; object-fit: contain;\">\r\n                                        <div class=\"flex-grow-1\">\r\n                                            <strong>Current Favicon:</strong> <?php echo basename($currentFavicon); ?>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                <?php endif; ?>\r\n                                \r\n                                <!-- Favicon Upload/Selection Tabs -->\r\n                                <ul class=\"nav nav-tabs\" id=\"faviconTabs\" role=\"tablist\">\r\n                                    <li class=\"nav-item\">\r\n                                        <a class=\"nav-link active\" id=\"upload-favicon-tab\" data-toggle=\"tab\" href=\"#upload-favicon\" role=\"tab\">\r\n                                            <i class=\"fas fa-upload mr-1\"></i> Upload New\r\n                                        </a>\r\n                                    </li>\r\n                                    <li class=\"nav-item\">\r\n                                        <a class=\"nav-link\" id=\"media-favicon-tab\" data-toggle=\"tab\" href=\"#media-favicon\" role=\"tab\">\r\n                                            <i class=\"fas fa-images mr-1\"></i> Select from Media\r\n                                        </a>\r\n                                    </li>\r\n                                </ul>\r\n                                \r\n                                <div class=\"tab-content mt-3\">\r\n                                    <!-- Upload New Favicon -->\r\n                                    <div class=\"tab-pane fade show active\" id=\"upload-favicon\" role=\"tabpanel\">\r\n                                        <div class=\"custom-file\">\r\n                                            <input type=\"file\" class=\"custom-file-input\" id=\"site_favicon_upload\" name=\"site_favicon_upload\" accept=\"image/*\">\r\n                                            <label class=\"custom-file-label\" for=\"site_favicon_upload\">Choose favicon file</label>\r\n                                        </div>\r\n                                        <small class=\"form-text text-muted\">Recommended size: 32x32 pixels. Supported formats: PNG, ICO</small>\r\n                                    </div>\r\n                                    \r\n                                    <!-- Select from Media Library -->\r\n                                    <div class=\"tab-pane fade\" id=\"media-favicon\" role=\"tabpanel\">\r\n                                        <?php if (count($mediaFiles) > 0): ?>\r\n                                        <div class=\"media-gallery\" style=\"max-height: 200px; overflow-y: auto;\">\r\n                                            <div class=\"row\">\r\n                                                <?php foreach ($mediaFiles as $media): ?>\r\n                                                <div class=\"col-md-2 col-sm-3 col-4 mb-2\">\r\n                                                    <div class=\"media-item-favicon\" data-media-path=\"<?php echo $media[\'file_path\']; ?>\" style=\"cursor: pointer; border: 2px solid transparent; border-radius: 8px; padding: 5px;\">\r\n                                                        <img src=\"<?php echo SITE_URL . \'/\' . $media[\'file_path\']; ?>\" \r\n                                                             alt=\"<?php echo htmlspecialchars($media[\'original_name\']); ?>\" \r\n                                                             class=\"img-fluid rounded\" \r\n                                                             style=\"width: 100%; height: 40px; object-fit: cover;\">\r\n                                                        <small class=\"d-block text-center mt-1\" style=\"font-size: 9px;\"><?php echo htmlspecialchars(substr($media[\'original_name\'], 0, 10)); ?></small>\r\n                                                    </div>\r\n                                                </div>\r\n                                                <?php endforeach; ?>\r\n                                            </div>\r\n                                        </div>\r\n                                        <input type=\"hidden\" name=\"selected_favicon_media\" id=\"selected_favicon_media\">\r\n                                        <?php else: ?>\r\n                                        <div class=\"alert alert-info\">\r\n                                            <i class=\"fas fa-info-circle mr-2\"></i>\r\n                                            No media files found. <a href=\"../media/\" target=\"_blank\">Upload some images to the media library</a> first.\r\n                                        </div>\r\n                                        <?php endif; ?>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        \r\n                        <!-- Logo Preview -->\r\n                        <div class=\"col-md-4\">\r\n                            <div class=\"form-group\">\r\n                                <label>Logo Preview</label>\r\n                                <div class=\"border rounded p-3 text-center\" style=\"min-height: 150px; background: #f8f9fa;\">\r\n                                    <div id=\"logo-preview-container\" style=\"display: flex; align-items: center; justify-content: center; height: 120px;\">\r\n                                        <div id=\"logo-preview\">\r\n                                            <!-- Dynamic preview will be inserted here -->\r\n                                        </div>\r\n                                    </div>\r\n                                    <small class=\"text-muted\">Logo Preview</small>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                \r\n                <!-- Colors & Appearance Settings -->\r\n                <div class=\"tab-pane fade\" id=\"appearance\" role=\"tabpanel\" aria-labelledby=\"appearance-tab\">\r\n                    <div class=\"alert alert-info\">\r\n                        <i class=\"fas fa-info-circle mr-2\"></i>\r\n                        <strong>Note:</strong> Color changes will be applied to the frontend design. Make sure the colors provide good contrast for accessibility.\r\n                    </div>\r\n                    \r\n                    <!-- Primary Colors -->\r\n                    <div class=\"card mb-4\">\r\n                        <div class=\"card-header\">\r\n                            <h5 class=\"mb-0\"><i class=\"fas fa-palette mr-2\"></i>Primary Colors</h5>\r\n                        </div>\r\n                        <div class=\"card-body\">\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-3\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"primary_color\">Primary Color</label>\r\n                                        <div class=\"input-group\">\r\n                                            <input type=\"color\" class=\"form-control\" id=\"primary_color\" name=\"primary_color\" \r\n                                                   value=\"<?php echo getSetting(\'primary_color\', \'#5D5CDE\'); ?>\" style=\"height: 40px;\">\r\n                                            <div class=\"input-group-append\">\r\n                                                <span class=\"input-group-text\"><?php echo getSetting(\'primary_color\', \'#5D5CDE\'); ?></span>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                \r\n                                <div class=\"col-md-3\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"secondary_color\">Secondary Color</label>\r\n                                        <div class=\"input-group\">\r\n                                            <input type=\"color\" class=\"form-control\" id=\"secondary_color\" name=\"secondary_color\" \r\n                                                   value=\"<?php echo getSetting(\'secondary_color\', \'#6c757d\'); ?>\" style=\"height: 40px;\">\r\n                                            <div class=\"input-group-append\">\r\n                                                <span class=\"input-group-text\"><?php echo getSetting(\'secondary_color\', \'#6c757d\'); ?></span>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                \r\n                                <div class=\"col-md-3\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"header_color\">Header Color</label>\r\n                                        <div class=\"input-group\">\r\n                                            <input type=\"color\" class=\"form-control\" id=\"header_color\" name=\"header_color\" \r\n                                                   value=\"<?php echo getSetting(\'header_color\', \'#1E3A8A\'); ?>\" style=\"height: 40px;\">\r\n                                            <div class=\"input-group-append\">\r\n                                                <span class=\"input-group-text\"><?php echo getSetting(\'header_color\', \'#1E3A8A\'); ?></span>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                \r\n                                <div class=\"col-md-3\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"footer_color\">Footer Color</label>\r\n                                        <div class=\"input-group\">\r\n                                            <input type=\"color\" class=\"form-control\" id=\"footer_color\" name=\"footer_color\" \r\n                                                   value=\"<?php echo getSetting(\'footer_color\', \'#1E3A8A\'); ?>\" style=\"height: 40px;\">\r\n                                            <div class=\"input-group-append\">\r\n                                                <span class=\"input-group-text\"><?php echo getSetting(\'footer_color\', \'#1E3A8A\'); ?></span>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    \r\n                    <!-- Status Colors -->\r\n                    <div class=\"card mb-4\">\r\n                        <div class=\"card-header\">\r\n                            <h5 class=\"mb-0\"><i class=\"fas fa-exclamation-circle mr-2\"></i>Status Colors</h5>\r\n                        </div>\r\n                        <div class=\"card-body\">\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-3\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"success_color\">Success Color</label>\r\n                                        <div class=\"input-group\">\r\n                                            <input type=\"color\" class=\"form-control\" id=\"success_color\" name=\"success_color\" \r\n                                                   value=\"<?php echo getSetting(\'success_color\', \'#28a745\'); ?>\" style=\"height: 40px;\">\r\n                                            <div class=\"input-group-append\">\r\n                                                <span class=\"input-group-text\"><?php echo getSetting(\'success_color\', \'#28a745\'); ?></span>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                \r\n                                <div class=\"col-md-3\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"warning_color\">Warning Color</label>\r\n                                        <div class=\"input-group\">\r\n                                            <input type=\"color\" class=\"form-control\" id=\"warning_color\" name=\"warning_color\" \r\n                                                   value=\"<?php echo getSetting(\'warning_color\', \'#ffc107\'); ?>\" style=\"height: 40px;\">\r\n                                            <div class=\"input-group-append\">\r\n                                                <span class=\"input-group-text\"><?php echo getSetting(\'warning_color\', \'#ffc107\'); ?></span>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                \r\n                                <div class=\"col-md-3\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"danger_color\">Danger Color</label>\r\n                                        <div class=\"input-group\">\r\n                                            <input type=\"color\" class=\"form-control\" id=\"danger_color\" name=\"danger_color\" \r\n                                                   value=\"<?php echo getSetting(\'danger_color\', \'#dc3545\'); ?>\" style=\"height: 40px;\">\r\n                                            <div class=\"input-group-append\">\r\n                                                <span class=\"input-group-text\"><?php echo getSetting(\'danger_color\', \'#dc3545\'); ?></span>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                \r\n                                <div class=\"col-md-3\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"info_color\">Info Color</label>\r\n                                        <div class=\"input-group\">\r\n                                            <input type=\"color\" class=\"form-control\" id=\"info_color\" name=\"info_color\" \r\n                                                   value=\"<?php echo getSetting(\'info_color\', \'#17a2b8\'); ?>\" style=\"height: 40px;\">\r\n                                            <div class=\"input-group-append\">\r\n                                                <span class=\"input-group-text\"><?php echo getSetting(\'info_color\', \'#17a2b8\'); ?></span>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    \r\n                    <!-- Background & Text Colors -->\r\n                    <div class=\"card mb-4\">\r\n                        <div class=\"card-header\">\r\n                            <h5 class=\"mb-0\"><i class=\"fas fa-font mr-2\"></i>Background & Text Colors</h5>\r\n                        </div>\r\n                        <div class=\"card-body\">\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-3\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"body_bg_color\">Body Background</label>\r\n                                        <div class=\"input-group\">\r\n                                            <input type=\"color\" class=\"form-control\" id=\"body_bg_color\" name=\"body_bg_color\" \r\n                                                   value=\"<?php echo getSetting(\'body_bg_color\', \'#ffffff\'); ?>\" style=\"height: 40px;\">\r\n                                            <div class=\"input-group-append\">\r\n                                                <span class=\"input-group-text\"><?php echo getSetting(\'body_bg_color\', \'#ffffff\'); ?></span>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                \r\n                                <div class=\"col-md-3\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"text_color\">Text Color</label>\r\n                                        <div class=\"input-group\">\r\n                                            <input type=\"color\" class=\"form-control\" id=\"text_color\" name=\"text_color\" \r\n                                                   value=\"<?php echo getSetting(\'text_color\', \'#212529\'); ?>\" style=\"height: 40px;\">\r\n                                            <div class=\"input-group-append\">\r\n                                                <span class=\"input-group-text\"><?php echo getSetting(\'text_color\', \'#212529\'); ?></span>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                \r\n                                <div class=\"col-md-3\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"link_color\">Link Color</label>\r\n                                        <div class=\"input-group\">\r\n                                            <input type=\"color\" class=\"form-control\" id=\"link_color\" name=\"link_color\" \r\n                                                   value=\"<?php echo getSetting(\'link_color\', \'#007bff\'); ?>\" style=\"height: 40px;\">\r\n                                            <div class=\"input-group-append\">\r\n                                                <span class=\"input-group-text\"><?php echo getSetting(\'link_color\', \'#007bff\'); ?></span>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                \r\n                                <div class=\"col-md-3\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"border_color\">Border Color</label>\r\n                                        <div class=\"input-group\">\r\n                                            <input type=\"color\" class=\"form-control\" id=\"border_color\" name=\"border_color\" \r\n                                                   value=\"<?php echo getSetting(\'border_color\', \'#dee2e6\'); ?>\" style=\"height: 40px;\">\r\n                                            <div class=\"input-group-append\">\r\n                                                <span class=\"input-group-text\"><?php echo getSetting(\'border_color\', \'#dee2e6\'); ?></span>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    \r\n                    <!-- Additional Colors -->\r\n                    <div class=\"card mb-4\">\r\n                        <div class=\"card-header\">\r\n                            <h5 class=\"mb-0\"><i class=\"fas fa-swatchbook mr-2\"></i>Additional Colors</h5>\r\n                        </div>\r\n                        <div class=\"card-body\">\r\n                            <div class=\"row\">\r\n                                <div class=\"col-md-6\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"light_color\">Light Color</label>\r\n                                        <div class=\"input-group\">\r\n                                            <input type=\"color\" class=\"form-control\" id=\"light_color\" name=\"light_color\" \r\n                                                   value=\"<?php echo getSetting(\'light_color\', \'#f8f9fa\'); ?>\" style=\"height: 40px;\">\r\n                                            <div class=\"input-group-append\">\r\n                                                <span class=\"input-group-text\"><?php echo getSetting(\'light_color\', \'#f8f9fa\'); ?></span>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                \r\n                                <div class=\"col-md-6\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"dark_color\">Dark Color</label>\r\n                                        <div class=\"input-group\">\r\n                                            <input type=\"color\" class=\"form-control\" id=\"dark_color\" name=\"dark_color\" \r\n                                                   value=\"<?php echo getSetting(\'dark_color\', \'#343a40\'); ?>\" style=\"height: 40px;\">\r\n                                            <div class=\"input-group-append\">\r\n                                                <span class=\"input-group-text\"><?php echo getSetting(\'dark_color\', \'#343a40\'); ?></span>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                \r\n                <!-- Navigation Settings -->\r\n                <div class=\"tab-pane fade\" id=\"navigation\" role=\"tabpanel\" aria-labelledby=\"navigation-tab\">\r\n                    <div class=\"row\">\r\n                        <div class=\"col-md-6\">\r\n                            <div class=\"form-group\">\r\n                                <label for=\"nav_style\">Navigation Style</label>\r\n                                <select class=\"form-control\" id=\"nav_style\" name=\"nav_style\">\r\n                                    <option value=\"horizontal\" <?php echo getSetting(\'nav_style\', \'horizontal\') === \'horizontal\' ? \'selected\' : \'\'; ?>>Horizontal</option>\r\n                                    <option value=\"vertical\" <?php echo getSetting(\'nav_style\', \'horizontal\') === \'vertical\' ? \'selected\' : \'\'; ?>>Vertical</option>\r\n                                </select>\r\n                            </div>\r\n                            \r\n                            <div class=\"form-group\">\r\n                                <label for=\"nav_position\">Navigation Position</label>\r\n                                <select class=\"form-control\" id=\"nav_position\" name=\"nav_position\">\r\n                                    <option value=\"top\" <?php echo getSetting(\'nav_position\', \'top\') === \'top\' ? \'selected\' : \'\'; ?>>Top</option>\r\n                                    <option value=\"bottom\" <?php echo getSetting(\'nav_position\', \'top\') === \'bottom\' ? \'selected\' : \'\'; ?>>Bottom</option>\r\n                                    <option value=\"left\" <?php echo getSetting(\'nav_position\', \'top\') === \'left\' ? \'selected\' : \'\'; ?>>Left Sidebar</option>\r\n                                    <option value=\"right\" <?php echo getSetting(\'nav_position\', \'top\') === \'right\' ? \'selected\' : \'\'; ?>>Right Sidebar</option>\r\n                                </select>\r\n                            </div>\r\n                            \r\n                            <div class=\"form-group\">\r\n                                <div class=\"custom-control custom-switch\">\r\n                                    <input type=\"checkbox\" class=\"custom-control-input\" id=\"show_breadcrumbs\" name=\"show_breadcrumbs\" \r\n                                           <?php echo getSetting(\'show_breadcrumbs\', \'yes\') === \'yes\' ? \'checked\' : \'\'; ?>>\r\n                                    <label class=\"custom-control-label\" for=\"show_breadcrumbs\">Show Breadcrumbs</label>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        \r\n                        <div class=\"col-md-6\">\r\n                            <div class=\"form-group\">\r\n                                <label for=\"custom_menu_items\">Custom Menu Items (JSON Format)</label>\r\n                                <textarea class=\"form-control\" id=\"custom_menu_items\" name=\"custom_menu_items\" rows=\"10\" \r\n                                          placeholder=\'[\r\n  {\r\n    \"title\": \"Services\",\r\n    \"url\": \"services.php\",\r\n    \"icon\": \"fas fa-cog\",\r\n    \"target\": \"_self\"\r\n  },\r\n  {\r\n    \"title\": \"Help\",\r\n    \"url\": \"help.php\", \r\n    \"icon\": \"fas fa-question-circle\",\r\n    \"target\": \"_self\"\r\n  }\r\n]\'><?php echo htmlspecialchars(getSetting(\'custom_menu_items\', \'\')); ?></textarea>\r\n                                <small class=\"form-text text-muted\">\r\n                                    Add custom menu items in JSON format. Each item should have: title, url, icon (optional), target (optional).\r\n                                </small>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    \r\n                    <div class=\"alert alert-info\">\r\n                        <i class=\"fas fa-info-circle mr-2\"></i>\r\n                        <strong>Navigation Tips:</strong>\r\n                        <ul class=\"mb-0 mt-2\">\r\n                            <li>Use relative URLs for internal pages (e.g., \"about.php\")</li>\r\n                            <li>Use absolute URLs for external links (e.g., \"https://example.com\")</li>\r\n                            <li>Icons should be FontAwesome classes (e.g., \"fas fa-home\")</li>\r\n                            <li>Target can be \"_self\" (same window) or \"_blank\" (new window)</li>\r\n                        </ul>\r\n                    </div>\r\n                </div>\r\n                \r\n                <!-- Contact Info Settings -->\r\n                <div class=\"tab-pane fade\" id=\"contact\" role=\"tabpanel\" aria-labelledby=\"contact-tab\">\r\n                    <div class=\"row\">\r\n                        <div class=\"col-md-6\">\r\n                            <div class=\"form-group\">\r\n                                <label for=\"contact_phone\">Contact Phone</label>\r\n                                <input type=\"tel\" class=\"form-control\" id=\"contact_phone\" name=\"contact_phone\" \r\n                                       value=\"<?php echo htmlspecialchars(getSetting(\'contact_phone\', \'\')); ?>\" \r\n                                       placeholder=\"+1234567890\">\r\n                            </div>\r\n                            \r\n                            <div class=\"form-group\">\r\n                                <label for=\"contact_whatsapp\">WhatsApp Number</label>\r\n                                <input type=\"tel\" class=\"form-control\" id=\"contact_whatsapp\" name=\"contact_whatsapp\" \r\n                                       value=\"<?php echo htmlspecialchars(getSetting(\'contact_whatsapp\', \'\')); ?>\" \r\n                                       placeholder=\"+1234567890\">\r\n                                <small class=\"form-text text-muted\">Include country code (e.g., +1234567890)</small>\r\n                            </div>\r\n                        </div>\r\n                        \r\n                        <div class=\"col-md-6\">\r\n                            <div class=\"form-group\">\r\n                                <label for=\"contact_email\">Contact Email</label>\r\n                                <input type=\"email\" class=\"form-control\" id=\"contact_email\" name=\"contact_email\" \r\n                                       value=\"<?php echo htmlspecialchars(getSetting(\'contact_email\', \'\')); ?>\" \r\n                                       placeholder=\"info@example.com\">\r\n                            </div>\r\n                            \r\n                            <div class=\"form-group\">\r\n                                <label for=\"contact_address\">Business Address</label>\r\n                                <textarea class=\"form-control\" id=\"contact_address\" name=\"contact_address\" rows=\"3\" \r\n                                          placeholder=\"Enter your business address\"><?php echo htmlspecialchars(getSetting(\'contact_address\', \'\')); ?></textarea>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                \r\n                <!-- Social Media Settings -->\r\n                <div class=\"tab-pane fade\" id=\"social\" role=\"tabpanel\" aria-labelledby=\"social-tab\">\r\n                    <div class=\"row\">\r\n                        <div class=\"col-md-6\">\r\n                            <div class=\"form-group\">\r\n                                <label for=\"social_facebook\">Facebook Page URL</label>\r\n                                <div class=\"input-group\">\r\n                                    <div class=\"input-group-prepend\">\r\n                                        <span class=\"input-group-text\"><i class=\"fab fa-facebook-f\"></i></span>\r\n                                    </div>\r\n                                    <input type=\"url\" class=\"form-control\" id=\"social_facebook\" name=\"social_facebook\" \r\n                                           value=\"<?php echo htmlspecialchars(getSetting(\'social_facebook\', \'\')); ?>\" \r\n                                           placeholder=\"https://facebook.com/yourpage\">\r\n                                </div>\r\n                            </div>\r\n                            \r\n                            <div class=\"form-group\">\r\n                                <label for=\"social_twitter\">Twitter Profile URL</label>\r\n                                <div class=\"input-group\">\r\n                                    <div class=\"input-group-', '2025-07-05 04:31:45', '2025-07-22 14:26:34');
INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `created_at`, `updated_at`) VALUES
(151, 'maintenance_mode', 'no', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(152, 'maintenance_message', 'আমাদের সেবাসমূহের মান আরও উন্নত করার লক্ষ্যে সাইটের রক্ষণাবেক্ষণের কাজ চলছে।\r\nআমরা শীঘ্রই আবার অনলাইনে ফিরে আসব।\r\nআপনার সহনশীলতা ও ধৈর্যের জন্য আন্তরিক কৃতজ্ঞতা ও ধন্যবাদ।', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(153, 'enable_captcha', 'no', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(154, 'recaptcha_site_key', '6LdQZnsrAAAAAM3e4LHOdyzTP6dTWLgaUZ7iJ3Cm', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(155, 'recaptcha_secret_key', '6LdQZnsrAAAAAKhsE2QSi6KPhkyhNcseE11njXp0', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(156, 'enable_caching', 'no', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(157, 'cache_duration', '60', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(158, 'enable_compression', 'no', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(159, 'minify_assets', 'no', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(160, 'email_method', 'mail', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(161, 'smtp_host', 'smtp.gmail.com', '2025-07-05 04:31:45', '2025-08-29 15:39:32'),
(162, 'smtp_port', '587', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(163, 'smtp_encryption', 'tls', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(164, 'smtp_username', '', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(165, 'smtp_password', '', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(166, 'email_from_name', '', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(167, 'email_from_address', '', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(168, 'enable_api', 'no', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(169, 'api_rate_limit', '60', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(170, 'allowed_origins', '*', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(171, 'api_require_auth', 'no', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(172, 'header_scripts', '<!-- Google tag (gtag.js) -->\r\n<script async src=\"https://www.googletagmanager.com/gtag/js?id=G-2SXKHXZBEG\"></script>\r\n<script>\r\n  window.dataLayer = window.dataLayer || [];\r\n  function gtag(){dataLayer.push(arguments);}\r\n  gtag(\'js\', new Date());\r\n\r\n  gtag(\'config\', \'G-2SXKHXZBEG\');\r\n</script>', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(173, 'footer_scripts', '<!--Start of Tawk.to Script-->\r\n<script type=\"text/javascript\">\r\nvar Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n(function(){\r\nvar s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\ns1.async=true;\r\ns1.src=\'https://embed.tawk.to/6869a98370e7fd1919383828/1ivebsat9\';\r\ns1.charset=\'UTF-8\';\r\ns1.setAttribute(\'crossorigin\',\'*\');\r\ns0.parentNode.insertBefore(s1,s0);\r\n})();\r\n</script>\r\n<!--End of Tawk.to Script-->', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(174, 'custom_css', '', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(175, 'debug_mode', 'no', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(176, 'log_queries', 'no', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(177, 'log_level', 'debug', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(178, 'enable_profiler', 'no', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(179, 'auto_backup', 'no', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(180, 'backup_frequency', 'daily', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(181, 'backup_retention', '30', '2025-07-05 04:31:45', '2025-07-22 14:26:34'),
(182, 'logo_type', 'text', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(183, 'site_logo', 'assets/uploads/media/686bd41dec0b7.jpeg', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(184, 'site_favicon', 'assets/uploads/media/686ae538b7536_1751835960.png', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(185, 'logo_size', 'medium', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(186, 'logo_position', 'center', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(187, 'logo_max_width', '500', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(188, 'logo_max_height', '90', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(189, 'success_color', '#28a745', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(190, 'warning_color', '#ffc107', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(191, 'danger_color', '#dc3545', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(192, 'info_color', '#17a2b8', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(193, 'light_color', '#dcddee', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(194, 'dark_color', '#343a40', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(195, 'body_bg_color', '#ffffb6', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(196, 'text_color', '#212529', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(197, 'link_color', '#007bff', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(198, 'border_color', '#d1e2e6', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(199, 'nav_style', 'horizontal', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(200, 'nav_position', 'top', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(201, 'show_breadcrumbs', 'yes', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(202, 'custom_menu_items', '', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(203, 'social_youtube', '', '2025-07-07 21:09:54', '2025-07-22 14:26:34'),
(204, 'google_analytics_code', '<!-- Google tag (gtag.js) -->\r\n<script async src=\"https://www.googletagmanager.com/gtag/js?id=G-2SXKHXZBEG\"></script>\r\n<script>\r\n  window.dataLayer = window.dataLayer || [];\r\n  function gtag(){dataLayer.push(arguments);}\r\n  gtag(\'js\', new Date());\r\n\r\n  gtag(\'config\', \'G-2SXKHXZBEG\');\r\n</script>', '2025-07-08 20:11:06', '2025-07-22 14:26:34'),
(205, 'site_tagline', 'Exchange Taka Globally', '2025-07-22 14:26:34', '2025-07-22 14:26:34'),
(206, 'operator_status', 'online', '2025-07-22 14:26:34', '2025-07-22 14:26:34'),
(207, 'working_hours', '9 am-11.50pm +6', '2025-07-22 14:26:34', '2025-07-22 14:26:34'),
(208, 'enable_notification_sound', 'yes', '2025-07-22 14:26:34', '2025-07-22 14:26:34'),
(209, 'primary_color', '#5d5cde', '2025-07-22 14:26:34', '2025-07-22 14:26:34'),
(210, 'secondary_color', '#6c757d', '2025-07-22 14:26:34', '2025-07-22 14:26:34'),
(211, 'header_color', '#1e3a8a', '2025-07-22 14:26:34', '2025-07-22 14:26:34'),
(212, 'footer_color', '#1e3a8a', '2025-07-22 14:26:34', '2025-07-22 14:26:34'),
(213, 'contact_phone', '', '2025-07-22 14:26:34', '2025-07-22 14:26:34'),
(214, 'contact_whatsapp', '', '2025-07-22 14:26:34', '2025-07-22 14:26:34'),
(215, 'contact_email', '', '2025-07-22 14:26:34', '2025-07-22 14:26:34'),
(216, 'contact_address', '', '2025-07-22 14:26:34', '2025-07-22 14:26:34'),
(217, 'google_site_verification', '', '2025-07-22 14:26:34', '2025-07-22 14:26:34'),
(218, 'google_analytics_id', '', '2025-07-22 14:26:34', '2025-07-22 14:26:34'),
(219, 'facebook_pixel_id', '', '2025-07-22 14:26:34', '2025-07-22 14:26:34'),
(248, 'smtp_enabled', 'yes', '2025-08-29 15:39:32', '2025-08-29 15:39:32'),
(249, 'smtp_secure', 'tls', '2025-08-29 15:39:32', '2025-08-29 15:39:32'),
(250, 'smtp_from_email', '', '2025-08-29 15:39:32', '2025-08-29 15:39:32'),
(251, 'smtp_from_name', '', '2025-08-29 15:39:32', '2025-08-29 15:39:32'),
(252, 'google_oauth_enabled', 'no', '2025-08-29 15:39:32', '2025-08-29 15:39:32'),
(253, 'google_client_id', '', '2025-08-29 15:39:32', '2025-08-29 15:39:32'),
(254, 'google_client_secret', '', '2025-08-29 15:39:32', '2025-08-29 15:39:32'),
(255, 'user_system_enabled', 'yes', '2025-08-29 15:39:32', '2025-08-29 15:39:32'),
(256, 'require_email_verification', 'yes', '2025-08-29 15:39:32', '2025-08-29 15:39:32'),
(257, 'allow_google_signup', 'yes', '2025-08-29 15:39:32', '2025-08-29 15:39:32');

-- --------------------------------------------------------

--
-- Table structure for table `site_users`
--

CREATE TABLE `site_users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `email_verification_token` varchar(255) DEFAULT NULL,
  `google_id` varchar(100) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `login_type` enum('email','google') NOT NULL DEFAULT 'email',
  `status` enum('active','blocked','suspended') NOT NULL DEFAULT 'active',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rating` int(1) NOT NULL DEFAULT 5,
  `message` text DEFAULT NULL,
  `from_currency` varchar(10) DEFAULT NULL,
  `to_currency` varchar(10) DEFAULT NULL,
  `status` enum('pending','active','inactive') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `email`, `rating`, `message`, `from_currency`, `to_currency`, `status`, `created_at`, `updated_at`, `ip_address`, `user_agent`) VALUES
(1, 'Hamim Wahid', '', 5, 'Very Good Service', 'USD', 'BDT', 'active', '2025-06-03 05:32:45', '2025-06-03 05:32:45', NULL, NULL),
(2, 'Saieed Rahman', 'info.saidur_bd@aol.com', 5, 'Very First Service', 'Nagad', 'Paypal', 'active', '2025-07-07 06:18:09', '2025-07-07 06:18:29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tutorials_ads`
--

CREATE TABLE `tutorials_ads` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `type` enum('video_upload','image_upload','youtube_embed','facebook_embed','google_drive_embed','adsense') NOT NULL,
  `file_path` varchar(500) DEFAULT NULL,
  `thumbnail` varchar(500) DEFAULT NULL,
  `embed_code` text DEFAULT NULL,
  `adsense_code` text DEFAULT NULL,
  `priority` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `display_on_homepage` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tutorials_ads`
--

INSERT INTO `tutorials_ads` (`id`, `title`, `description`, `type`, `file_path`, `thumbnail`, `embed_code`, `adsense_code`, `priority`, `status`, `display_on_homepage`, `created_by`, `created_at`, `updated_at`) VALUES
(8, 'Test', 'Testing video', 'video_upload', '68a5cce7e3c6b_1755696359.mp4', 'thumb_68a5cce7e412e_1755696359.webp', NULL, NULL, 1, 'active', 0, 1, '2025-08-20 13:25:59', '2025-08-21 19:19:12'),
(10, 'PHP Script', 'Test', 'youtube_embed', NULL, NULL, 'https://youtu.be/0Yo3n3fIsK4?si=HIsDVDvTDFI1ty1G', NULL, 0, 'active', 1, 1, '2025-08-21 19:18:54', '2025-08-22 13:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','manager','editor') NOT NULL DEFAULT 'editor',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'EBAdmin', 'info.saidur_bd@aol.com', '$2y$10$2i8ufIbxD/9/LQvDYZDq0.BwGi5rm.PJdUfcD2dKuFPKb5FMBtgXi', 'admin', 'active', '2025-09-09 18:40:07', '2025-07-21 22:45:42', '2025-09-09 12:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_exchanges`
--

CREATE TABLE `user_exchanges` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `exchange_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text DEFAULT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

CREATE TABLE `user_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `from_currency` varchar(10) NOT NULL,
  `to_currency` varchar(10) NOT NULL,
  `amount` decimal(20,8) NOT NULL,
  `rate` decimal(20,8) NOT NULL,
  `fee` decimal(20,8) DEFAULT 0.00000000,
  `total` decimal(20,8) NOT NULL,
  `status` enum('pending','completed','cancelled') NOT NULL DEFAULT 'pending',
  `details` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banned_ips`
--
ALTER TABLE `banned_ips`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ip_address` (`ip_address`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `currency_rates`
--
ALTER TABLE `currency_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_currency` (`currency_code`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `template_key` (`template_key`);

--
-- Indexes for table `exchanges`
--
ALTER TABLE `exchanges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference_id` (`reference_id`),
  ADD KEY `idx_created_at` (`created_at`),
  ADD KEY `idx_currencies` (`from_currency`,`to_currency`);

--
-- Indexes for table `exchange_rates`
--
ALTER TABLE `exchange_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currency_pair` (`from_currency`,`to_currency`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `floating_buttons`
--
ALTER TABLE `floating_buttons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `license_logs`
--
ALTER TABLE `license_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_type` (`event_type`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `mail_settings`
--
ALTER TABLE `mail_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uploaded_by` (`uploaded_by`),
  ADD KEY `file_type` (`file_type`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_settings`
--
ALTER TABLE `oauth_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `provider` (`provider`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `token` (`token`);

--
-- Indexes for table `rate_limits`
--
ALTER TABLE `rate_limits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rate_key` (`rate_key`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `reserves`
--
ALTER TABLE `reserves`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currency_code` (`currency_code`);

--
-- Indexes for table `security_logs`
--
ALTER TABLE `security_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_type` (`event_type`),
  ADD KEY `ip_address` (`ip_address`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`),
  ADD KEY `idx_setting_key` (`setting_key`);

--
-- Indexes for table `site_users`
--
ALTER TABLE `site_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `google_id` (`google_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutorials_ads`
--
ALTER TABLE `tutorials_ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `display_on_homepage` (`display_on_homepage`),
  ADD KEY `priority` (`priority`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_exchanges`
--
ALTER TABLE `user_exchanges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `exchange_id` (`exchange_id`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banned_ips`
--
ALTER TABLE `banned_ips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `currency_rates`
--
ALTER TABLE `currency_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exchanges`
--
ALTER TABLE `exchanges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `exchange_rates`
--
ALTER TABLE `exchange_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `floating_buttons`
--
ALTER TABLE `floating_buttons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `mail_settings`
--
ALTER TABLE `mail_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `oauth_settings`
--
ALTER TABLE `oauth_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rate_limits`
--
ALTER TABLE `rate_limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=750;

--
-- AUTO_INCREMENT for table `reserves`
--
ALTER TABLE `reserves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `security_logs`
--
ALTER TABLE `security_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `site_users`
--
ALTER TABLE `site_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tutorials_ads`
--
ALTER TABLE `tutorials_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_exchanges`
--
ALTER TABLE `user_exchanges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_exchanges`
--
ALTER TABLE `user_exchanges`
  ADD CONSTRAINT `user_exchanges_ibfk_1` FOREIGN KEY (`exchange_id`) REFERENCES `exchanges` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
