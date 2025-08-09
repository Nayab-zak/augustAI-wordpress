import React, { useState, useEffect } from 'react'
import { Bar } from 'react-chartjs-2'
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend,
} from 'chart.js'
import { Calculator, DollarSign, Clock, Calendar, TrendingUp, ArrowRight } from 'lucide-react'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'

ChartJS.register(
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend
)

const ROICalculatorPage = () => {
  const [hoursPerWeek, setHoursPerWeek] = useState(10)
  const [hourlyCost, setHourlyCost] = useState(50)
  const [months, setMonths] = useState(12)
  const [results, setResults] = useState(null)

  const openCalendly = () => {
    window.open('https://calendly.com/admin-august/30min', '_blank')
  }

  const calculateROI = () => {
    // Formula: roi = hours_saved_per_week * hourly_cost * 4 * months
    const totalSavings = hoursPerWeek * hourlyCost * 4 * months
    const monthlySavings = hoursPerWeek * hourlyCost * 4
    const weeklySavings = hoursPerWeek * hourlyCost
    
    // Assuming average automation investment of $5,000-$15,000
    const estimatedInvestment = Math.min(15000, Math.max(5000, totalSavings * 0.2))
    const netSavings = totalSavings - estimatedInvestment
    const roiPercentage = ((netSavings / estimatedInvestment) * 100).toFixed(0)
    const paybackMonths = Math.ceil(estimatedInvestment / monthlySavings)

    setResults({
      totalSavings,
      monthlySavings,
      weeklySavings,
      estimatedInvestment,
      netSavings,
      roiPercentage,
      paybackMonths
    })
  }

  useEffect(() => {
    calculateROI()
  }, [hoursPerWeek, hourlyCost, months])

  const formatCurrency = (amount) => {
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
      minimumFractionDigits: 0,
      maximumFractionDigits: 0,
    }).format(amount)
  }

  const chartData = results ? {
    labels: ['Investment', 'Total Savings', 'Net Profit'],
    datasets: [
      {
        label: 'Amount (USD)',
        data: [results.estimatedInvestment, results.totalSavings, results.netSavings],
        backgroundColor: [
          'rgba(167, 90, 53, 0.8)',  // August copper for investment
          'rgba(34, 197, 94, 0.8)',  // Green for savings
          'rgba(59, 130, 246, 0.8)', // Blue for profit
        ],
        borderColor: [
          'rgba(167, 90, 53, 1)',
          'rgba(34, 197, 94, 1)',
          'rgba(59, 130, 246, 1)',
        ],
        borderWidth: 2,
        borderRadius: 8,
      },
    ],
  } : null

  const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false,
      },
      title: {
        display: true,
        text: 'ROI Analysis Over ' + months + ' Months',
        font: {
          size: 16,
          weight: 'bold',
        },
        color: '#374151',
      },
      tooltip: {
        callbacks: {
          label: function(context) {
            return formatCurrency(context.parsed.y)
          }
        }
      }
    },
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          callback: function(value) {
            return formatCurrency(value)
          }
        },
        grid: {
          color: 'rgba(0, 0, 0, 0.1)',
        }
      },
      x: {
        grid: {
          display: false,
        }
      }
    },
  }

  const generateROINarrative = () => {
    if (!results) return ""
    
    const { roiPercentage, paybackMonths, totalSavings, netSavings } = results
    
    let narrative = `Based on your inputs, automating ${hoursPerWeek} hours per week at $${hourlyCost}/hour would generate ${formatCurrency(totalSavings)} in total savings over ${months} months. `
    
    if (netSavings > 0) {
      narrative += `After an estimated investment of ${formatCurrency(results.estimatedInvestment)}, you'd achieve a ${roiPercentage}% ROI with ${formatCurrency(netSavings)} in net profit. `
      narrative += `The automation would pay for itself in just ${paybackMonths} month${paybackMonths > 1 ? 's' : ''}, `
      narrative += `then continue generating ${formatCurrency(results.monthlySavings)} in monthly savings.`
    } else {
      narrative += `While the initial investment might be higher, the long-term benefits of automation extend beyond immediate cost savings, including improved accuracy, scalability, and employee satisfaction.`
    }
    
    return narrative
  }

  return (
    <div className="pt-16 lg:pt-20">
      {/* Header */}
      <section className="py-20 bg-gradient-to-br from-gray-50 to-white">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
          <div className="flex justify-center mb-6">
            <div className="p-4 copper-accent-bg text-white rounded-full">
              <Calculator className="h-8 w-8" />
            </div>
          </div>
          <h1 className="text-4xl md:text-5xl font-bold text-gray-900">
            ROI <span className="brand-gradient">Calculator</span>
          </h1>
          <p className="text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto">
            Calculate the potential return on investment for automating your workflows. 
            See how much time and money you could save with AI automation.
          </p>
        </div>
      </section>

      {/* Calculator */}
      <section className="py-20 bg-white">
        <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {/* Input Form */}
            <Card className="shadow-lg border-0">
              <CardHeader>
                <CardTitle className="text-2xl font-bold text-gray-900 flex items-center space-x-2">
                  <DollarSign className="h-6 w-6 copper-accent" />
                  <span>Calculate Your Savings</span>
                </CardTitle>
              </CardHeader>
              <CardContent className="space-y-6">
                <div className="space-y-2">
                  <Label htmlFor="hours" className="text-sm font-medium text-gray-700 flex items-center space-x-2">
                    <Clock className="h-4 w-4" />
                    <span>Hours saved per week</span>
                  </Label>
                  <Input
                    id="hours"
                    type="number"
                    min="1"
                    max="168"
                    value={hoursPerWeek}
                    onChange={(e) => setHoursPerWeek(Number(e.target.value))}
                    className="text-lg"
                  />
                  <p className="text-sm text-gray-500">
                    How many hours per week could be automated?
                  </p>
                </div>

                <div className="space-y-2">
                  <Label htmlFor="cost" className="text-sm font-medium text-gray-700 flex items-center space-x-2">
                    <DollarSign className="h-4 w-4" />
                    <span>Average hourly cost (USD)</span>
                  </Label>
                  <Input
                    id="cost"
                    type="number"
                    min="1"
                    max="500"
                    value={hourlyCost}
                    onChange={(e) => setHourlyCost(Number(e.target.value))}
                    className="text-lg"
                  />
                  <p className="text-sm text-gray-500">
                    Include salary, benefits, and overhead costs
                  </p>
                </div>

                <div className="space-y-2">
                  <Label htmlFor="months" className="text-sm font-medium text-gray-700 flex items-center space-x-2">
                    <Calendar className="h-4 w-4" />
                    <span>Time period (months)</span>
                  </Label>
                  <Input
                    id="months"
                    type="number"
                    min="1"
                    max="60"
                    value={months}
                    onChange={(e) => setMonths(Number(e.target.value))}
                    className="text-lg"
                  />
                  <p className="text-sm text-gray-500">
                    Calculate ROI over how many months?
                  </p>
                </div>

                <div className="pt-4 border-t">
                  <Button
                    onClick={openCalendly}
                    className="w-full brand-gradient-bg text-white hover:opacity-90 text-lg py-3"
                  >
                    Discuss Your Automation Project
                  </Button>
                </div>
              </CardContent>
            </Card>

            {/* Results */}
            {results && (
              <Card className="shadow-lg border-0">
                <CardHeader>
                  <CardTitle className="text-2xl font-bold text-gray-900 flex items-center space-x-2">
                    <TrendingUp className="h-6 w-6 text-green-600" />
                    <span>Your ROI Analysis</span>
                  </CardTitle>
                </CardHeader>
                <CardContent className="space-y-6">
                  {/* Key Metrics */}
                  <div className="grid grid-cols-2 gap-4">
                    <div className="text-center p-4 bg-green-50 rounded-lg">
                      <div className="text-2xl font-bold text-green-600">
                        {formatCurrency(results.totalSavings)}
                      </div>
                      <div className="text-sm text-gray-600">Total Savings</div>
                    </div>
                    <div className="text-center p-4 bg-blue-50 rounded-lg">
                      <div className="text-2xl font-bold text-blue-600">
                        {results.roiPercentage}%
                      </div>
                      <div className="text-sm text-gray-600">ROI</div>
                    </div>
                  </div>

                  {/* Breakdown */}
                  <div className="space-y-3">
                    <div className="flex justify-between items-center py-2 border-b">
                      <span className="text-gray-600">Weekly Savings:</span>
                      <span className="font-semibold">{formatCurrency(results.weeklySavings)}</span>
                    </div>
                    <div className="flex justify-between items-center py-2 border-b">
                      <span className="text-gray-600">Monthly Savings:</span>
                      <span className="font-semibold">{formatCurrency(results.monthlySavings)}</span>
                    </div>
                    <div className="flex justify-between items-center py-2 border-b">
                      <span className="text-gray-600">Estimated Investment:</span>
                      <span className="font-semibold">{formatCurrency(results.estimatedInvestment)}</span>
                    </div>
                    <div className="flex justify-between items-center py-2 border-b">
                      <span className="text-gray-600">Payback Period:</span>
                      <span className="font-semibold">{results.paybackMonths} month{results.paybackMonths > 1 ? 's' : ''}</span>
                    </div>
                    <div className="flex justify-between items-center py-2 font-bold text-lg">
                      <span className="text-gray-900">Net Profit:</span>
                      <span className={results.netSavings > 0 ? "text-green-600" : "text-orange-600"}>
                        {formatCurrency(results.netSavings)}
                      </span>
                    </div>
                  </div>
                </CardContent>
              </Card>
            )}
          </div>

          {/* Chart */}
          {results && chartData && (
            <div className="mt-12">
              <Card className="shadow-lg border-0">
                <CardContent className="p-6">
                  <div className="h-80">
                    <Bar data={chartData} options={chartOptions} />
                  </div>
                </CardContent>
              </Card>
            </div>
          )}

          {/* ROI Narrative */}
          {results && (
            <div className="mt-12">
              <Card className="shadow-lg border-0 bg-gradient-to-r from-blue-50 to-indigo-50">
                <CardContent className="p-8">
                  <h3 className="text-xl font-bold text-gray-900 mb-4 flex items-center space-x-2">
                    <ArrowRight className="h-5 w-5 copper-accent" />
                    <span>Your ROI Story</span>
                  </h3>
                  <p className="text-gray-700 leading-relaxed text-lg">
                    {generateROINarrative()}
                  </p>
                  <div className="mt-6">
                    <Button
                      onClick={openCalendly}
                      className="brand-gradient-bg text-white hover:opacity-90"
                    >
                      Let's Make This Reality
                    </Button>
                  </div>
                </CardContent>
              </Card>
            </div>
          )}
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-20 brand-gradient-bg text-white">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
          <h2 className="text-3xl md:text-4xl font-bold">
            Ready to Start Saving?
          </h2>
          <p className="text-xl opacity-90">
            These calculations are just the beginning. Let's discuss your specific automation needs and create a custom solution.
          </p>
          <Button
            onClick={openCalendly}
            size="lg"
            className="bg-white text-[var(--august-copper-accent)] hover:bg-gray-100 text-lg px-8 py-4"
          >
            Schedule Your Consultation
          </Button>
        </div>
      </section>
    </div>
  )
}

export default ROICalculatorPage

