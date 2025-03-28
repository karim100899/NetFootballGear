<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Inquiries - Football Merchandise</title>
    <link rel="icon" href="images/NetFootballGear-flaticon.png" type="image/png">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/business-inquiry.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'header.php'; ?>

<main class="business-inquiry-page">
    <div class="container">
        <?php if ($success): ?>
            <div class="success-message">
                <div class="message-content">
                    <i class="fas fa-check-circle"></i>
                    <h2>Thank You for Your Interest!</h2>
                    <p>Your business inquiry has been successfully submitted. Our team will review your information and contact you within 2-3 business days.</p>
                    <a href="index.php" class="back-button">Return to Homepage</a>
                </div>
            </div>
        <?php else: ?>
            <div class="page-header">
                <h1>Business Inquiries</h1>
                <p>Would you like to sell your products on NetFootballGear? Fill out the form below to start the conversation.</p>
            </div>
            
            <?php if ($error): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <div class="inquiry-content">
                <div class="information-section">
                    <h2>Partner With Us</h2>
                    <p>At NetFootballGear, we're always looking to expand our product range with high-quality football merchandise. By partnering with us, you'll reach thousands of football fans looking for their next favorite item.</p>
                    
                    <div class="benefits">
                        <div class="benefit-item">
                            <i class="fas fa-globe"></i>
                            <h3>Global Reach</h3>
                            <p>Get your products in front of an international audience of passionate football fans.</p>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-chart-line"></i>
                            <h3>Increased Sales</h3>
                            <p>Leverage our marketing and customer base to boost your product sales.</p>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-handshake"></i>
                            <h3>Simple Process</h3>
                            <p>Our streamlined onboarding makes it easy to start selling quickly.</p>
                        </div>
                    </div>
                    
                    <div class="contact-info">
                        <h3>Have Questions?</h3>
                        <p>For immediate assistance, contact our business development team:</p>
                        <p><i class="fas fa-envelope"></i> 100899@glr.nl</p>
                        <p><i class="fas fa-phone"></i> +31 123 456 789</p>
                    </div>
                </div>
                
                <div class="form-section">
                    <h2>Submit Your Business Inquiry</h2>
                    <form action="business-inquiry.php" method="POST" enctype="multipart/form-data" class="business-form">
                        <div class="form-group">
                            <label for="company_name">Company Name <span class="required">*</span></label>
                            <input type="text" id="company_name" name="company_name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact_name">Contact Name <span class="required">*</span></label>
                            <input type="text" id="contact_name" name="contact_name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address <span class="required">*</span></label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone">
                        </div>

                        <div class="form-group">
                            <label for="product_name">Product Name:</label>
                            <input type="text" id="product_name" name="product_name" required>
                        </div>

                        <label for="image">Image:</label>
                        <input type="file" id="image" name="image" accept="image/*" required>
                        
                        <div class="form-group">
                            <label for="product_type">Product Type <span class="required">*</span></label>
                            <select id="product_type" name="product_type" required>
                                <option value="">Select a category</option>
                                <option value="Jerseys">Jerseys</option>
                                <option value="Footwear">Footwear</option>
                                <option value="Equipment">Equipment</option>
                                <option value="Training Gear">Training Gear</option>
                                <option value="Fan Merchandise">Fan Merchandise</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" id="price" name="price" step="0.01" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Tell us about your products <span class="required">*</span></label>
                            <textarea id="message" name="message" rows="5" required placeholder="Please include information about your products, pricing, and why they would be a good fit for our store."></textarea>
                        </div>
                        
                        <div class="form-terms">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">I agree to the processing of my data according to the <a href="privacy.php">Privacy Policy</a> <span class="required">*</span></label>
                        </div>
                        
                        <button type="submit" class="submit-button">Submit Business Inquiry</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include 'footer.php'; ?>
<script src="js/main.js"></script>
</body>
</html> 