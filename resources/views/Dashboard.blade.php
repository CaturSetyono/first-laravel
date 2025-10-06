<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body style="margin: 0; padding: 0; font-family: 'Inter', sans-serif; background-color: #f0f2f5;">
    <!-- Navigation Bar -->
    <nav style="background-color: #ffffff; padding: 1rem 2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto;">
            <h1 style="margin: 0; color: #1a1a1a; font-size: 1.5rem;">Admin Dashboard</h1>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <span style="color: #666;">Welcome, Admin</span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="max-width: 1200px; margin: 2rem auto; padding: 0 2rem;">
        <!-- Welcome Section -->
        <div style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); border-radius: 1rem; padding: 2rem; color: white; margin-bottom: 2rem;">
            <h2 style="margin: 0 0 1rem 0; font-size: 2rem;">Welcome Back! 👋</h2>
            <p style="margin: 0; opacity: 0.9;">Here's what's happening with your projects today.</p>
        </div>

        <!-- Stats Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <!-- Stat Card 1 -->
            <div style="background: white; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 0.5rem 0; color: #666;">Total Users</h3>
                <p style="margin: 0; font-size: 1.875rem; font-weight: 600; color: #1a1a1a;">2,543</p>
                <p style="margin: 0.5rem 0 0 0; color: #22c55e; font-size: 0.875rem;">↑ 12.5% from last month</p>
            </div>

            <!-- Stat Card 2 -->
            <div style="background: white; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 0.5rem 0; color: #666;">Active Projects</h3>
                <p style="margin: 0; font-size: 1.875rem; font-weight: 600; color: #1a1a1a;">12</p>
                <p style="margin: 0.5rem 0 0 0; color: #22c55e; font-size: 0.875rem;">↑ 3 new this week</p>
            </div>

            <!-- Stat Card 3 -->
            <div style="background: white; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 0.5rem 0; color: #666;">Total Revenue</h3>
                <p style="margin: 0; font-size: 1.875rem; font-weight: 600; color: #1a1a1a;">$45,678</p>
                <p style="margin: 0.5rem 0 0 0; color: #22c55e; font-size: 0.875rem;">↑ 8.2% from last month</p>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div style="background: white; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 1rem 0; color: #1a1a1a;">Recent Activity</h3>
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <!-- Activity Item -->
                <div style="display: flex; align-items: center; padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb;">
                    <div style="width: 40px; height: 40px; background-color: #e0e7ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                        <span style="color: #4f46e5;">📊</span>
                    </div>
                    <div>
                        <p style="margin: 0; color: #1a1a1a;">New project "Dashboard UI" created</p>
                        <p style="margin: 0; color: #666; font-size: 0.875rem;">2 hours ago</p>
                    </div>
                </div>

                <!-- Activity Item -->
                <div style="display: flex; align-items: center; padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb;">
                    <div style="width: 40px; height: 40px; background-color: #f0fdf4; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                        <span style="color: #22c55e;">💰</span>
                    </div>
                    <div>
                        <p style="margin: 0; color: #1a1a1a;">Payment received from client</p>
                        <p style="margin: 0; color: #666; font-size: 0.875rem;">5 hours ago</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>