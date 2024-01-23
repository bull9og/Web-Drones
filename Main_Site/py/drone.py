import cv2
import numpy as np

# Connect to the drone's Wi-Fi access point and get the video stream
cap = cv2.VideoCapture('http://drone_ip_address:port/video_feed')

# Create a window to display the video feed
cv2.namedWindow('Drone Feed', cv2.WINDOW_NORMAL)

while True:
    # Read a frame from the video stream
    ret, frame = cap.read()

    # Display the frame in the window
    cv2.imshow('Drone Feed', frame)

    # Break the loop if the user presses the 'q' key
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Release the video stream and close the window
cap.release()
cv2.destroyAllWindows()