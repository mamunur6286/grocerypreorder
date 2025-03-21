# Pre Order confirmation

Your pre-order has been placed. Below are the details:

**Order ID:** 0000{{ $preOrder->id }}  
**Customer Name:** {{ $preOrder->name }}  
**Email:** {{ $preOrder->email }}  
**Total Amount:** {{ $preOrder->phone }}  
**Total Amount:** {{ $preOrder->description }}  


Thank you for managing the orders!

Best Regards,  
{{ config('app.name') }}
