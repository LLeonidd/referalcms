$('#footer_phone_number').html(formatPhoneNumber(_phone_number_human));$('#number_phone').html(formatPhoneNumber(_phone_number_human));$('#contact_items #number_phone_contact').html('<i class=\"la la-mobile-phone\"></i> '+_phone_number_human+'');$('#contact_items #number_phone_contact').attr('href', 'tel:'+_phone_number_raw);$('#contact_items #whatsapp_link').attr('href', 'https://api.whatsapp.com/send?phone='+_phone_number_raw+'&amp;text='+_whats_app_message);$($('.social_wrapper li')[0]).find('a').attr('href', 'https://api.whatsapp.com/send?phone='+_phone_number_raw+'&amp;text='+_whats_app_message);$('#men_1 a').html('<i class=\"la la-mobile-phone\"></i> '+_phone_number_human);$('#men_1 a').attr('href', 'tel:'+_phone_number_raw);$('.phone-mobile-header a').html('<i class=\"la la-mobile-phone\"></i> '+_phone_number_human);$('.phone-mobile-header a').attr('href', 'tel:'+_phone_number_raw);
