<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Confirmation - Kagzi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 30px 20px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 300;
        }
        
        .content {
            padding: 30px;
        }
        
        .success-badge {
            background-color: #10b981;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .details-section {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        
        .details-section h3 {
            margin-top: 0;
            color: #374151;
            font-size: 18px;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: #6b7280;
        }
        
        .detail-value {
            color: #374151;
            font-weight: 500;
        }
        
        .highlight {
            background-color: #3b82f6;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .price-highlight {
            background-color: #10b981;
            color: white;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 700;
        }
        
        .footer {
            background-color: #374151;
            color: #d1d5db;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }
        
        .footer a {
            color: #3b82f6;
            text-decoration: none;
        }
        
        .user-id-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 14px;
            display: inline-block;
            margin: 10px 0;
        }

        @media (max-width: 600px) {
            .container {
                margin: 0 10px;
            }
            
            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
            
            .detail-value {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🎉 Purchase Successful!</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Thank you for your purchase</p>
        </div>
        
        <!-- Content -->
        <div class="content">
            <div class="success-badge">
                ✓ Payment Confirmed
            </div>
            
            <p style="font-size: 16px; margin-bottom: 20px;">
                Hello <strong>{{ $purchase->customer_name }}</strong>,
            </p>
            
            <p>Your purchase has been successfully processed! Here are your order details:</p>
            
            <!-- User Information -->
            <div class="details-section">
                <h3>👤 Customer Information</h3>
                <div class="detail-row">
                    <span class="detail-label">User ID:</span>
                    <span class="user-id-badge">{{ $userDisplayId }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Name:</span>
                    <span class="detail-value">{{ $purchase->customer_name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">{{ $purchase->customer_email }}</span>
                </div>
            </div>
            
            <!-- Product Information -->
            <div class="details-section">
                <h3>📦 Product Details</h3>
                <div class="detail-row">
                    <span class="detail-label">Product:</span>
                    <span class="detail-value">{{ $product->name }}</span>
                </div>
                @if($pricing)
                <div class="detail-row">
                    <span class="detail-label">Plan:</span>
                    <span class="detail-value">{{ $pricing->title }}</span>
                </div>
                @if($pricing->type_value && $pricing->type)
                <div class="detail-row">
                    <span class="detail-label">{{ ucfirst($pricing->type) }}:</span>
                    <span class="detail-value">
                        <span class="highlight">{{ $pricing->type_value }} 
                        @if($pricing->type === 'credit')
                            credits
                        @endif
                        </span>
                    </span>
                </div>
                @endif
                @endif
                @if($product->product_type === 'credit' && $product->credit_value)
                <div class="detail-row">
                    <span class="detail-label">Credits Received:</span>
                    <span class="detail-value">
                        <span class="highlight">{{ $product->credit_value }} credits</span>
                    </span>
                </div>
                @endif
            </div>
            
            <!-- Payment Information -->
            <div class="details-section">
                <h3>💳 Payment Information</h3>
                <div class="detail-row">
                    <span class="detail-label">Transaction ID:</span>
                    <span class="detail-value">{{ $purchase->transaction_id }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Payment Method:</span>
                    <span class="detail-value">{{ ucfirst($purchase->payment_gateway) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Amount Paid:</span>
                    <span class="price-highlight">{{ $purchase->formatted_amount }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Purchase Date:</span>
                    <span class="detail-value">{{ $purchase->created_at->format('d M Y, h:i A') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Status:</span>
                    <span class="detail-value">
                        <span style="color: #10b981; font-weight: 600;">✓ {{ ucfirst($purchase->status) }}</span>
                    </span>
                </div>
            </div>
            
            <!-- Additional Information -->
            <div style="background-color: #fef3c7; border-radius: 8px; padding: 15px; margin: 20px 0; border-left: 4px solid #f59e0b;">
                <p style="margin: 0; color: #92400e;">
                    <strong>📝 Important:</strong> Please save this email for your records. Your User ID <strong>{{ $userDisplayId }}</strong> will be required for any future support requests.
                </p>
            </div>
            
            <p style="margin-top: 30px;">
                If you have any questions about your purchase, please don't hesitate to contact our support team.
            </p>
            
            <p style="margin-top: 20px;">
                <strong>Thank you for choosing Kagzi!</strong><br>
                The Kagzi Team
            </p>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p style="margin: 0;">
                &copy; {{ date('Y') }} Kagzi. All rights reserved.<br>
                <a href="mailto:support@kagzi.com">support@kagzi.com</a> | 
                <a href="{{ config('app.url') }}">Visit our website</a>
            </p>
        </div>
    </div>
</body>
</html>

