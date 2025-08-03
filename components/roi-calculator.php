<?php
/**
 * ROI Calculator Component
 * Interactive calculator for automation savings
 */
?>

<!-- ROI Calculator -->
<section class="py-20 px-4 bg-gradient-to-r from-purple-900/20 to-pink-900/20" role="complementary" aria-labelledby="roi-heading">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12 fade-in">
            <h2 id="roi-heading" class="text-4xl font-bold mb-6 gradient-text">ROI Calculator</h2>
            <p class="text-xl text-gray-300">See how much you could save with automation</p>
        </div>
        
        <div class="glass-card p-8">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <label for="hours-per-week" class="block text-sm font-medium text-gray-300 mb-2">Hours spent on manual tasks per week</label>
                        <input type="number" id="hours-per-week" class="calculator-input" placeholder="40" value="40" min="1" max="168">
                    </div>
                    
                    <div>
                        <label for="hourly-rate" class="block text-sm font-medium text-gray-300 mb-2">Average hourly rate ($)</label>
                        <input type="number" id="hourly-rate" class="calculator-input" placeholder="35" value="35" min="10" max="500">
                    </div>
                    
                    <div>
                        <label for="automation-cost" class="block text-sm font-medium text-gray-300 mb-2">Automation cost ($)</label>
                        <input type="number" id="automation-cost" class="calculator-input" placeholder="1200" value="1200" min="500" max="10000">
                    </div>
                    
                    <div>
                        <label for="efficiency-gain" class="block text-sm font-medium text-gray-300 mb-2">Expected efficiency gain (%)</label>
                        <input type="range" id="efficiency-gain" class="w-full" min="20" max="90" value="70">
                        <div class="flex justify-between text-sm text-gray-400 mt-1">
                            <span>20%</span>
                            <span id="efficiency-display" class="font-semibold text-purple-400">70%</span>
                            <span>90%</span>
                        </div>
                    </div>
                    
                    <button onclick="calculateROI()" class="btn-primary w-full" id="calculate-btn">
                        <i class="fas fa-calculator mr-2"></i>
                        Calculate ROI
                    </button>
                </div>
                
                <div class="space-y-4">
                    <h3 class="text-xl font-bold mb-4 gradient-text">Your Savings Potential</h3>
                    <div class="space-y-3 text-lg">
                        <div class="flex justify-between">
                            <span>Hours saved per week:</span>
                            <span id="hours-saved" class="font-bold text-green-400">28 hours</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Weekly savings:</span>
                            <span id="weekly-savings" class="font-bold gradient-text">$980</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Monthly savings:</span>
                            <span id="monthly-savings" class="font-bold gradient-text">$4,240</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Annual savings:</span>
                            <span id="annual-savings" class="font-bold gradient-text text-xl">$50,880</span>
                        </div>
                        <div class="pt-4 border-t border-gray-600">
                            <div class="flex justify-between">
                                <span>Break-even time:</span>
                                <span id="break-even" class="font-bold text-yellow-400">3.2 weeks</span>
                            </div>
                            <div class="flex justify-between mt-2">
                                <span>ROI in first month:</span>
                                <span id="roi-percentage" class="font-bold text-green-400 text-xl">354%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// ROI Calculator functionality
function calculateROI() {
    const hoursPerWeek = parseFloat(document.getElementById('hours-per-week').value) || 40;
    const hourlyRate = parseFloat(document.getElementById('hourly-rate').value) || 35;
    const automationCost = parseFloat(document.getElementById('automation-cost').value) || 1200;
    const efficiencyGain = parseFloat(document.getElementById('efficiency-gain').value) || 70;
    
    // Calculate savings
    const hoursSaved = hoursPerWeek * (efficiencyGain / 100);
    const weeklySavings = hoursSaved * hourlyRate;
    const monthlySavings = weeklySavings * 4.33; // Average weeks per month
    const annualSavings = weeklySavings * 52;
    
    // Calculate ROI
    const breakEvenWeeks = automationCost / weeklySavings;
    const monthlyROI = ((monthlySavings - (automationCost / 12)) / (automationCost / 12)) * 100;
    
    // Update display
    document.getElementById('hours-saved').textContent = hoursSaved.toFixed(1) + ' hours';
    document.getElementById('weekly-savings').textContent = '$' + weeklySavings.toLocaleString(undefined, {maximumFractionDigits: 0});
    document.getElementById('monthly-savings').textContent = '$' + monthlySavings.toLocaleString(undefined, {maximumFractionDigits: 0});
    document.getElementById('annual-savings').textContent = '$' + annualSavings.toLocaleString(undefined, {maximumFractionDigits: 0});
    document.getElementById('break-even').textContent = breakEvenWeeks.toFixed(1) + ' weeks';
    document.getElementById('roi-percentage').textContent = Math.max(0, monthlyROI).toFixed(0) + '%';
}

// Update efficiency display
document.getElementById('efficiency-gain').addEventListener('input', function() {
    document.getElementById('efficiency-display').textContent = this.value + '%';
    calculateROI();
});

// Auto-calculate on input changes
['hours-per-week', 'hourly-rate', 'automation-cost'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculateROI);
});

// Initial calculation
document.addEventListener('DOMContentLoaded', calculateROI);
</script>
